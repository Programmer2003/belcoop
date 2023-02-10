<?php
include 'db.php';

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $query = "INSERT INTO `product` (`name`, `price`, `category`) VALUES ('{$name}','{$price}','{$category}')";
    if (mysqli_query($link, $query) === TRUE) {
        $arr = array('id' => $link->insert_id, 'code'=> 200);
        echo json_encode($arr);
    } else {
        throw new Exception("Error: <br>" . $link->error);
    }
}
else{
    throw new Exception("Некорректные данные");
}
