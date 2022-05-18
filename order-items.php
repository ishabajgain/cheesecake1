<?php
require_once("entity.php");

class Orderitems extends Entity
{
  private static $table_name = 'order_items';
  private static $primary_key = 'o_id';

  public $o_id, $quantity, $total_amount, $items;
}