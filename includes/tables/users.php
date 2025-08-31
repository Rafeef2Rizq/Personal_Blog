<?php
$sql="CREATE TABLE IF NOT EXISTS users(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$stmt=$conn->exec($sql);

$username = "rafeef";
$email = "rafeef@gmail.com";
$password = password_hash("123456", PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->execute([':email' => $email]);
if ($stmt->fetchColumn() > 0) {
    echo "";
} else {
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $password
    ]);
    echo "User added successfully!";
}



