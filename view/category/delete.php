<?php
session_start();

$conn = require '../../includes/db.php';

$category_id = $_GET['id'] ?? null;

if (!$category_id) {
    die("No Category ID provided");
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM post_category WHERE category_id = :id");
$stmt->execute([':id' => $category_id]);
$count = $stmt->fetchColumn();

if ($count > 0) {
    $_SESSION['error'] = "❌ Cannot delete category. It has related posts!";
} else {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->execute([':id' => $category_id]);
    $_SESSION['success'] = "✅ Category deleted successfully!";
}
    $_SESSION['success'] = "✅ Post deleted successfully!";

header("Location: index.php");
exit;

