<?php
require_once("entity.php");

class Payment extends Entity
{
  private static $table_name = 'payments';
  private static $primary_key = 'id';

  public $d, $order_number, $cardholder_name, $number, $expiry, $cvv, $payment_status;
}