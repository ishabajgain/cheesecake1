<?php
require_once("entity.php");

class Order extends Entity
{
  private static $table_name = 'orders';
  private static $primary_key = 'id';
  public $id, $u_id, $created_at, $order_status;
}