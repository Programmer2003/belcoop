<?php
include "db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $query = "UPDATE `product` SET `name`='{$name}',`price`='{$price}',`category`='{$category}' WHERE `id`='{$id}'";
    if (mysqli_query($link, $query) === TRUE) {
        echo 200;
    } else {
        echo 502;
    }
}


