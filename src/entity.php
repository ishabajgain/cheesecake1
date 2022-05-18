<?php
require_once("connection.php");

abstract class Entity
{
  protected static $db_connection;

  private static function initDB() {
    if (is_null(self::$db_connection)) { 
      try {
        self::$db_connection = new PDO('mysql:host='.$GLOBALS['DB_HOST'].';dbname='.$GLOBALS['DB_NAME'].'', $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD']);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }
  }
  
  private static function findTableName() {
    $class = new \ReflectionClass(get_called_class());
    $table_name = $class->getStaticPropertyValue('table_name');
    return $table_name;
  }

  private static function findPrimaryKey() {
    $class = new \ReflectionClass(get_called_class());
    $primary_key = $class->getStaticPropertyValue('primary_key');
    return $primary_key;
  }

  public function __construct() {
    self::initDB();
  }

  public static function findAll($options = [], $order_key = '', $order_dir = 'DESC', $limit = 9999) {
    $values = [];
    $offset = 0;

    $table_name = self::findTableName();
    self::initDB();

    $sql = "SELECT * FROM ".$table_name;
    if (count($options) > 0 && isset($options['where'])) {
      foreach($options['where'] as $key => $value) {
        // appending AND
        if ($key === 0 ) {
          $sql = $sql." WHERE ";
        } else {
          $sql = $sql." AND ";
        }
        if ($value['operand'] === 'IN') {
          if(count($value['value']) === 0) {
            return [];
          }
          $in_placeholders = str_repeat('?,', count($value['value']) - 1) . '?';
          $sql = $sql.$value['key']." ".$value['operand']." (".$in_placeholders.")";
          $values = array_merge($values, $value['value']);
        } else {
          $sql = $sql.$value['key']." ".$value['operand']." ?";
          $values[] = $value['value'];
        }
      }
    }

    if ($order_key) {
      $sql = $sql." ORDER BY ".$order_key." ".$order_dir;
    }

    if ($limit) {
      $sql = $sql." LIMIT ".$limit. " OFFSET 0";
    }
    
    $sql = $sql.";";
    
    $statement = self::$db_connection->prepare($sql);
    $statement->execute($values);

    $result = [];
    while ($row = $statement->fetch()) {
      array_push($result, self::mapToEntity($row));
    }
    return $result;
  }

  public static function findById($id) {
    $table_name = self::findTableName();
    $primary_key = self::findPrimaryKey();
    self::initDB();

    $sql = "SELECT * FROM ".$table_name." where ".$primary_key." = ?;";
    $statement = self::$db_connection->prepare($sql);
    $statement->execute([$id]);
    
    $result = [];
    while ($row = $statement->fetch()) {
      array_push($result, self::mapToEntity($row));
    }  
    return count($result) > 0 ? $result[0] : null;
  }

  public function create() {
    $this->save('create');
  }

  public function update() {
    $this->save('update');
  }

  public function save($type) {
    $class = new \ReflectionClass(get_called_class());
    $table_name = self::findTableName();
    $primary_key = self::findPrimaryKey();
    $columns = [];
    $values = [];
    
    foreach($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
      $property_name = $prop->getName();
      if ($property_name != $primary_key) {
        $columns[] = $property_name;
        $values[] = $this->{$property_name};
        // $values[] = '`'.$property_name.'` = "'.$this->{$property_name}.'"';
      }
    }
    $column_expression = implode(',',$columns);
    $values_expression = implode(',', array_fill(0, count($values), '?'));

    $id = $this->{$primary_key};
    if ( $type === 'update') {
      // Sample Update sql Update users SET firstname=?, lastname=? where UID=2;
      $column_expression = implode('=?, ',$columns);
      $column_expression .="=?";
      $sql = 'UPDATE `'.$table_name.'` SET '.$column_expression.' WHERE '.$primary_key.' = '.$id;
    } else {
      // Sample Insert sql Insert into users (firstname, lastname) values (?, ?);
      $sql = 'INSERT INTO `'.$table_name.'` ('.$column_expression.') VALUES ('.$values_expression.');';
    }
    $statement = self::$db_connection->prepare($sql);
    $statement->execute($values);
    if (!$id) {
      $this->{$primary_key} = self::$db_connection->lastInsertId();
    }
    return $this;
  }

  public function delete() {
    $class = new \ReflectionClass(get_called_class());
    $table_name = self::findTableName();
    $primary_key = self::findPrimaryKey();
    $id = $this->{$primary_key};
    $values = [$id];
    if ($id) {
      $sql = 'DELETE FROM '.$table_name.' where '.$primary_key.' = ?;';
      $statement = self::$db_connection->prepare($sql);
      $statement->execute($values);
    }
  }

  public static function mapToEntity(array $object) {
    $class = new \ReflectionClass(get_called_class());
    $entity = $class->newInstance();

    foreach($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
      if (isset($object[$prop->getName()])) {
        $prop->setValue($entity, $object[$prop->getName()]);
      }
    }
    return $entity;
  }

  public static function rawQuery($sql) {
    $values = [];
    $table_name = self::findTableName();
    $primary_key = self::findPrimaryKey();
    self::initDB();

    $statement = self::$db_connection->prepare($sql);
    $statement->execute($values);

    $result = [];
    while ($row = $statement->fetch()) {
      array_push($result, $row);
    }
    return $result;
  }
}