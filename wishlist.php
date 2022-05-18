<?php
require_once ("entity.php");

class Wishlist extends Entity
{
	private static $table_name = 'wishlist_items';
	private static $primary_key = 'id';

  public $id, $product_id, $user_id;
}