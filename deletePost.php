<?php
include "db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $get = "SELECT * FROM `product` WHERE id = '{$id}'";
    // $query = "DELETE FROM `product` WHERE id = '{$id}'";
    if ($result = mysqli_query($link, $get)) {
        session_start();
        $_SESSION['deletedObj'] = $result->fetch_assoc();
        // if (mysqli_query($link, $query) === TRUE) {
        //     echo "Record deleted successfully";

        // } else {
        //     echo "Error: " . $sql . "<br>" . $link->error;
        // }
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
} else {
    echo "no such id";
}