<?php
return array(
// set your paypal credential
    'client_id' => 'ATtOj42nPwQ0pqDZ64OQH7imBnWYV9h0_7CpWyd7n_6ZRXrd-3V6A2RxtWcWjyIUva7sA2fiCH-gSVo4',
    'secret' => 'EPIF-7cvP7I3_GunEF1RUhLYPYDWg0II-YAG_qVYQ2n0LZf20ndCnT2cRsNl98LoDSFgBL40Qast2Itn',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . 'paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);