<?php

class quickbit
{

    private $api_key, $api_secret, $amount, $currency, $nounce, $customer_info, $invoice_id, $response, $post_fields, $order_hash, $microtime;

    private $merchant_info, $banking_info, $referral_code;

    private $login_info;

    private $crypto_currency;

    public function getResponse()
    {
        return $this->response;
    }

    public function setCustomer_info($customer_info)
    {
        $this->customer_info = $customer_info;
    }

    public function setInvoice_id($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    function __construct()
    {}

    function connect()
    {
        $ch = curl_init("https://sandbox.quickbit.pro/api_handler/");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post_fields);
        $responseData = curl_exec($ch);
        $this->response = json_decode($responseData, true);
    }

    function open_invoice($api_key, $api_secret, $amount, $currency, $crypto_currency = 'btc')
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->microtime = microtime(true);
        $this->crypto_currency = $crypto_currency;
        $this->nounce();
        
        $this->post_fields = array(
            'data' => json_encode(array(
                'amount' => utf8_encode($this->amount),
                'currency' => utf8_encode($this->currency),
                'api_key' => utf8_encode($this->api_key),
                'nounce' => utf8_encode($this->nounce),
                'customer_info' => $this->customer_info,
                'invoice_id' => utf8_encode($this->invoice_id),
                'microtime' => $this->microtime,
                'crypto_currency' => $this->crypto_currency,
                'type' => 'create_invoice'
            )),
            'type' => 'create_invoice'
        );
        $this->connect();
    }

    function checkStatus($api_key, $api_secret, $order_hash)
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->order_hash = $order_hash;
        $this->microtime = microtime(true);
        $this->nounce();
        
        $this->post_fields = array(
            'data' => json_encode(array(
                'apiKey' => utf8_encode($this->api_key),
                'nounce' => $this->nounce,
                'order_id' => utf8_encode($this->order_hash),
                'microtime' => $this->microtime,
                'type' => 'check_status'
            )),
            'type' => 'check_status'
        );
        $this->connect();
    }

    function register_merchant()
    {
        $this->post_fields = array(
            'data' => json_encode(array(
                'merchant_info' => $this->merchant_info,
                'banking_info' => $this->banking_info,
                'login_info' => $this->login_info,
                'referral_code' => '1'
            )),
            'type' => 'register_merchant'
        );
        $this->connect();
    }

    function nounce()
    {
        $this->nounce = hash('sha512', $this->api_secret . $this->microtime . $this->api_key);
    }

    public function setMerchantInfo($merchant_info)
    {
        $this->merchant_info = $merchant_info;
    }

    public function setBankingInfo($banking_info)
    {
        $this->banking_info = $banking_info;
    }

    public function setReferralCode($referral_code)
    {
        $this->referral_code = $referral_code;
    }

    public function setLoginInfo($login_info)
    {
        $this->login_info = $login_info;
    }
}
?>
