<?php
$sql="CREATE TABLE IF NOT EXISTS comments(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
content text ,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
user_id INT(6) UNSIGNED,
post_id INT(6) UNSIGNED,
FOREIGN KEY (post_id) REFERENCES posts(id),
FOREIGN KEY (user_id) REFERENCES users(id)
)";

$conn->exec($sql);

