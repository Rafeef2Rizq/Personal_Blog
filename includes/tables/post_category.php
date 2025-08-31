<?php
$sql="CREATE TABLE IF NOT EXISTS post_category(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
category_id INT(6) UNSIGNED,
post_id INT(6) UNSIGNED,
FOREIGN KEY (post_id ) REFERENCES posts(id),
FOREIGN KEY (category_id) REFERENCES categories(id)
)";

$conn->exec($sql);
