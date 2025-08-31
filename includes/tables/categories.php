<?php
$sql="CREATE TABLE IF NOT EXISTS categories(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL
)";

$conn->exec($sql);

