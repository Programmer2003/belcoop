<?php
include 'db.php';

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $query = "INSERT INTO `product` (`name`, `price`, `category`) VALUES ('{$name}','{$price}','{$category}')";
    if (mysqli_query($link, $query) === TRUE) {
        echo $link->insert_id;
    } else {
        throw new Exception("Error: <br>" . $link->error);
    }
}
else{
    throw new Exception("Некорректные данные");
}
