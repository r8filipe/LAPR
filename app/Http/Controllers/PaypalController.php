<?php
namespace App\Http\Controllers;

use App\Aluguer;
use App\Book;
use App\Purchase;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\payment as Payments;
use App\transaction as Transactions;
use App\payer as Payers;
use Auth;
use Session;
use PayPal;
use Config;
use URL;
use Redirect;

class PaypalController extends BaseController
{
    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment()
    {
        $data = Input::get('option');
        foreach ($data as $key => $value) {
            $id_books[] = $key;
            $article[$key] = array('option' => $value[0], 'days' => $value['day'], 'id' => $key);
        }
        $books = Book::select('id', 'title', 'price_day', 'price_bail', 'price_sale')->find($id_books);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = array();
        $subtotal = 0;
        $currency = 'EUR';
        foreach ($books as $producto) {
            if ($article[$producto->id]['option'] == 'rent' && $article[$producto->id]['days'] > 0)
                $price = ($producto->price_day * $article[$producto->id]['days']) + $producto->price_bail;
            else
                $price = $producto->price_sale;
            $item = new Item();
            $item->setName($producto->title)
                ->setCurrency($currency)
                ->setDescription($producto->title)
                ->setQuantity(1)
                ->setPrice($price)
                ->setSku($producto->id);
            $items[] = $item;
            $subtotal += $price;
        }
        $item_list = new ItemList();
        $item_list->setItems($items);
        $details = new Details();
        $details->setSubtotal($subtotal)
            ->setShipping(0);

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($subtotal)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba en mi Laravel App Store');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {

            $payment->create($this->_api_context);
        } catch (PayPal\Exception\PPConnectionException $ex) {
            if (Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('articles', $article);


        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }
        return Redirect::route('cart-show')
            ->with('error', 'Ups! Error desconocido.');
    }

    public function getPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        $payerId = Input::get('PayerID');
        $token = Input::get('token');
        //if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
        if (empty($payerId) || empty($token)) {
            return Redirect::route('home')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') { // payment made
            // Registrar el pedido --- ok
            // Registrar el Detalle del pedido  --- ok
            // Eliminar carrito
            // Enviar correo a user
            // Enviar correo a admin
            // Redireccionar
            $this->saveOrder($result);
            $this->saveAluguer(Session::get('articles'), $result->id);
            Session::forget('cart');
            Session::forget('articles');
            return Redirect::route('home')
                ->with('message', 'Compra realizada de forma correcta');
        }
        return Redirect::route('home')
            ->with('message', 'La compra fue cancelada');
    }

    private function saveOrder($result)
    {

        $payment = new Payments;
        $payment['payment_id'] = $result->id;
        $payment['state'] = $result->state;
        $payment['intent'] = $result->intent;
        $payment['cart'] = $result->cart;
        $payment['user_id'] = Auth::user()->id;
        $payment->save();

        $payer = new Payers;
        $payer['payer_id'] = $result->payer->payer_info->payer_id;
        $payer['payment_id'] = $result->id;
        $payer['email'] = $result->payer->payer_info->email;
        $payer['first_name'] = $result->payer->payer_info->first_name;
        $payer['last_name'] = $result->payer->payer_info->last_name;
        $payer['recipient_name'] = $result->payer->payer_info->shipping_address->recipient_name;
        $payer['line1'] = $result->payer->payer_info->shipping_address->line1;
        $payer['city'] = $result->payer->payer_info->shipping_address->city;
        $payer['state'] = $result->payer->payer_info->shipping_address->state;
        $payer['postal_code'] = $result->payer->payer_info->shipping_address->postal_code;
        $payer['phone'] = $result->payer->payer_info->phone;

        $payer->save();
        foreach ($result->transactions[0]->item_list->items as $item) {
            $transaction = new Transactions;
            $transaction['payment_id'] = $result->id;
            $transaction['book_id'] = $item->sku;
            $transaction['price'] = $item->price;
            $transaction['currency'] = $item->currency;
            $transaction['quantity'] = $item->quantity;
            $transaction['description'] = $item->description;
            $transaction->save();

            $book = Book::find($item->sku);
            $book['active'] = 0;
            $book->save();
        }
    }

    public function saveAluguer($articles, $payment_id)
    {

        foreach ($articles as $article) {
            if ($article['option'] == 'rent' && $article['days'] > 0) {
                $rent = new Aluguer;
                $rent->start = date('Y-m-d H:i:s');
                $rent->end = date('Y-m-d H:i:s', strtotime('+' . $article['days'] . ' days', strtotime($rent->start)));
                $rent->book_id = $article['id'];
                $rent->user_id = Auth::user()->id;
                $rent->payment_id = $payment_id;
                $rent->save();
            } else {
                $purchase = new Purchase;
                $purchase->book_id = $article['id'];
                $purchase->user_id = Auth::user()->id;
                $purchase->payment_id = $payment_id;
                $purchase->save();
            }
        }
    }


}