<?php require 'header.php'; ?>


<?php

require "connection.php";
$pdt = $_GET['pdt'];
$details = $pdo->query("SELECT * FROM prodcuts p JOIN categories c ON p.category_id = c.id WHERE p_id = $pdt")->fetch();

if (isset($_POST['book'])) {

  if (isset($_SESSION['customer_id'])) {
    $member = $_SESSION['customer_id'];
  }

  $stmt = $pdo->prepare("INSERT INTO orders(id, u_id, created_at, order_status)
                VALUES(:id, :u_id, :created_at, '0')");
  $criteria = [
    'id' => $_POST['id'],
    'u_id' => $member,
    'created_at' => $date['Y/m/d h:i:s'],

  ];
  $stmt->execute($criteria);
  if ($stmt == true) {
    echo "<script>alert('Thank your for ordering with us!!');</script>";
  }
}
?>