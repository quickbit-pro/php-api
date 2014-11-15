Quickbit php api
=======

##Basic Usage - Open new invoice
###Parameters
| Name  | Type | Required | Description |
| ------------- | ------------- | ------------- | ------------- |
|api_key  | String | Yes | Api key generated in Quickbit merchant admin (Payment tools -> Api generator) |
|api_secret  | String | Yes | Api secret generated in Quickbit merchant admin (Payment tools -> Api generator) |
|amount  | Double | Yes | Price in EUR/USD, must be higher or equal 5.00 |
|currency  | String | Yes | Valid inputs are EUR or USD |
|invoice_id  | String | No | Your invoice id or tracking hash |
###Example
```PHP
$api_key='';
$api_secret='';
$amount='';
$currency='';

$quickbit=new quickbit();
$quickbit->setInvoice_id($invoice_id);
$quickbit->open_invoice($api_key, $api_secret,$amount, $currency);
$response=$quickbit->getResponse();
echo '<iframe sandbox="allow-scripts" seamless width="100%" height="470px" src="'.$response['url'].'"></iframe>';
```
###Response

| Key | Type | Description |
| ------------- | ------------- | ------------- |
|address  | String | BTC payment address |
|pricePay  | Double | Price in BTC |
|qr  | String | Url for qr code |
|order_hash  | String | Unique order hash used for checking invoice status |
|url  | String | Url for embeded invoice |
|success  | Int |  <ul><li>0 -> Failed to retrieve information about invoice </li><li> 1 -> Operation was successful</li></ul> |

##Basic Usage - Check invoice status
###Parameters
| Name  | Type | Required | Description |
| ------------- | ------------- | ------------- | ------------- |
|api_key  | String | Yes | Api key generated in Quickbit merchant admin (Payment tools -> Api generator) |
|api_secret  | String | Yes | Api secret generated in Quickbit merchant admin (Payment tools -> Api generator) |
|order_hash  | String | Yes | Order hash which was returned at invoice creation |
###Example
```PHP
$api_key='';
$api_secret='';
$order_hash='';
$quickbit=new quickbit();
$quickbit->checkStatus($api_key, $api_secret,$order_hash);
$response=$quickbit->getResponse();
```
###Response

| Key | Type | Description |
| ------------- | ------------- | ------------- |
|success  | Int | <ul><li>0 -> Failed to retrieve information about invoice </li><li> 1 -> Operation was successful</li></ul> |
|status  | Int |  <ul><li>null->Failed to retrieve information </li><li> 1 -> Invoice is still open (unpaid) </li><li> 2 -> Invoice was paid in full </li><li> 3 -> Invoice is expired </li></ul>|

Quickbit php api
=======
Sandbox mode available on https://sandbox.quickbit.pro
You need to register new account.
For TESTING purposes only.
Do not send any coins on generated addresses!
