Quickbit php api
=======

##Basic Usage - Open new invoice
=======
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
|success  | Int | Values 0/1 0->Failed to retrive information about invoice, 1-> Operation was successful |

##Basic Usage - Check invoice status
=======
###Parameters
| Name  | Type | Required | Description |
| ------------- | ------------- | ------------- | ------------- |
|api_key  | String | Yes | Api key generated in Quickbit merchant admin (Payment tools -> Api generator) |
|api_secret  | String | Yes | Api secret generated in Quickbit merchant admin (Payment tools -> Api generator) |
|order_hash  | String | Yes | Order hash wich was returned at invoice creation |
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
|success  | Int | Values 0/1 0->Failed to retrive information about invoice, 1-> Operation was successful |
|status  | Int | null/1/2/3 null->Failed to retrive information, 1->Invoice is still open (unpaid),2-> Invoice was paid in full, 3->Invoice is expired |
