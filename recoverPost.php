<?php
include "db.php";
session_start();
if (isset($_SESSION['deletedObj'])) {
    $obj = $_SESSION['deletedObj'];
    unset($_SESSION['deletedObj']);
    $name = $obj['name'];
    $price = $obj['price'];
    $category = $obj['category'];
    $query = "INSERT INTO `product` (`name`, `price`, `category`) VALUES ('{$name}','{$price}','{$category}')";
    if (mysqli_query($link, $query) === TRUE) {
        $arr = array('id' => $link->insert_id, 'code'=> 200);
        echo json_encode($arr);
    } else {
        throw new Exception("Error: <br>" . $link->error);
    }
} else {
    throw new Exception("Something bad happened");
}


