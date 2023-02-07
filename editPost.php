<?php
include "db.php";

echo $_POST['id'];
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $query = "UPDATE `product` SET `name`='{$name}',`price`='{$price}',`category`='{$category}' WHERE `id`='{$id}'";
    echo $query;
    session_start();
    if (mysqli_query($link, $query) === TRUE) {
        $_SESSION['success'] = 'Запись обновлена';
    } else {
        $_SESSION['error'] = '1';
    }
}

$redicet = $_SERVER['HTTP_REFERER'];
@header("Location: $redicet");
