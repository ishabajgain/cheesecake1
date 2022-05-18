<?php
require_once("entity.php");

class Subcategory extends Entity
{
  private static $table_name = 'subcategory';
  private static $primary_key = 'id';

  public $id, $title, $category;
}