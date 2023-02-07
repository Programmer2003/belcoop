<?php
$link = mysqli_connect("localhost", "root", "", "storages", 3306);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    exit;
}
mysqli_set_charset($link, "utf8");
