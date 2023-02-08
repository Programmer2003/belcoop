<?php
include 'db.php';
$group = $_POST['id'];

$query = "SELECT `storage`.`name`,`storage`.`type`,`storage`.`address` FROM `storage` WHERE `id` = '{$group}' LIMIT 1";
if ($result = mysqli_query($link, $query)) {
    echo json_encode($result->fetch_assoc());
}
