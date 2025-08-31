<?php
$servername='localhost';
$username='root';
$password='';
$dbname='blogDB';

try{
$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
include 'tables/users.php';
include 'tables/posts.php';
include 'tables/comments.php';
include 'tables/categories.php';
include 'tables/post_category.php';


return $conn;
}catch(PDOException $e){
echo "".$e->getMessage();
}

