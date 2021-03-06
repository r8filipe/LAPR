<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Payment;
use App\Purchase;
use App\Aluguer;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getHistorico()
    {

        $sale = Transaction::whereHas('book', function ($q) {
            $q->where('id_user', '=', \Auth::user()->id);
        })->get();
        $sale->sum('price');


        $myRental = Aluguer::whereHas('book', function ($q) {
            $q->where('id_user', '=', \Auth::user()->id);
        })->get();


        $purchases = Purchase::where('user_id', '=', \Auth::user()->id)->get();
        $rental = Aluguer::where('user_id', '=', \Auth::user()->id)->get();

        $user = \App\User::find(\Auth::user()->id);
        return view('historico', ['purchases' => $purchases, 'sales' => $sale, 'rentals' => $rental, 'myRentals' => $myRental, 'user' => $user]);
    }
}
