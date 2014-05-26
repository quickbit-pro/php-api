Quickbit php api
=======

Basic Usage
=======
$quickbit=new quickbit();
$quickbit->setInvoice_id('');
$quickbit->open_invoice('#api_key', '#api_secret',$amount, $currency);
$response=$quickbit->getResponse();
