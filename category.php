<?php
require_once("entity.php");

class Category extends Entity
{
  private static $table_name = 'catagories';
  private static $primary_key = 'id';
  public $id, $itle;
}