<?php
require_once("entity.php");

class Product extends Entity
{
  private static $table_name = 'products';
  private static $primary_key = 'id';
  public $id, $itle, $price, $description, $category_id, $image_path, $subcategory;
}