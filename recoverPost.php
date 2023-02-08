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
        echo $link->insert_id;
    } else {
        throw new Exception("Error: <br>" . $link->error);
    }
} else {
    throw new Exception("Something bad happened");
}


