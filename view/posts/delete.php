<?php
session_start();

$conn = require '../../includes/db.php';
$uploadsdir = '../../uploads/';

// 1. نجيب id البوست من الرابط
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    die("No post ID provided");
}

// 2. نجيب بيانات البوست (خصوصًا الصورة)
$stmt = $conn->prepare("SELECT image FROM posts WHERE id = :id");
$stmt->execute([':id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($post) {
    // 3. إذا فيه صورة نحذفها من السيرفر
    if (!empty($post['image']) && file_exists($uploadsdir . $post['image'])) {
        unlink($uploadsdir . $post['image']);
    }

    // 4. نحذف أي ارتباطات بالتصنيفات (جدول pivot)
    $conn->prepare("DELETE FROM post_category WHERE post_id = :post_id")
         ->execute([':post_id' => $post_id]);

    // 5. نحذف البوست نفسه
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute([':id' => $post_id]);

    $_SESSION['success'] = "✅ Post deleted successfully!";
    header("Location: index.php");
    exit;
} else {
    echo "Post not found!";
}

