<?php
require_once("entity.php");

class User extends Entity
{
  private static $table_name = 'users';
  private static $primary_key = 'id';

  public $id, $full_name, $password, $email, $dateJoined, $address, $is_admin;
}