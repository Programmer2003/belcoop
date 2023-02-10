<?php
include "db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $get = "SELECT * FROM `product` WHERE id = '{$id}'";
    $query = "DELETE FROM `product` WHERE id = '{$id}'";
    if ($result = mysqli_query($link, $get)) {
        session_start();
        $_SESSION['deletedObj'] = $result->fetch_assoc();
        if (mysqli_query($link, $query) === TRUE) {
            $arr = array('code' => 200);
            echo json_encode($arr);
        } else {
            throw new Exception("Error: <br>" . $link->error);
        }
    } else {
        throw new Exception("Error: <br>" . $link->error);
    }
} else {
    throw new Exception("Нету такого товара");
}
