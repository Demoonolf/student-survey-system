<?php
$conn = new mysqli('localhost', 'dbname', 'Password', 'dbname');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
