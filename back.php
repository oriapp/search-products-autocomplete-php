<?php 

if( !empty($_GET['search']) ){
  
  $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
  $search = trim($search);

  if( $search ){

    $dbcon = 'mysql:host=localhost;dbname=eshop;charset=utf8';
    $db = new PDO($dbcon, 'root', '');
    $sql = "SELECT title FROM products WHERE title LIKE ?";
    $query = $db->prepare($sql);
    $query->execute(["%$search%"]);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    if($products) echo json_encode($products);
    
  }

}