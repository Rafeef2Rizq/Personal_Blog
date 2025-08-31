<?php
$sql="CREATE TABLE IF NOT EXISTS posts(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL,
excerpt VARCHAR(255) NOT NULL,
content text ,
image VARCHAR(255) ,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
user_id INT(6) UNSIGNED not null,
FOREIGN KEY (user_id) REFERENCES users(id)
)";

$conn->exec($sql);
