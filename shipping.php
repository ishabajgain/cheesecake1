<?php
require_once("entity.php");

class shipping extends Entity
{
  private static $table_name = 'shipping';
  private static $primary_key = 'id';

  public $id, $o_id, $address;
}