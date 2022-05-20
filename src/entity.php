<?php
require_once("connection.php");

abstract class Entity
{
  protected static $db_connection;

  private static function initDB()
  {
    if (is_null(self::$db_connection)) {
      try {
        self::$db_connection = new PDO('mysql:host=' . $GLOBALS['DB_HOST'] . ';dbname=' . $GLOBALS['DB_NAME'] . '', $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD']);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }
  }
}