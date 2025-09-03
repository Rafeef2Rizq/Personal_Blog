<?php
session_start();

$conn = require '../../includes/db.php';
$uploadsdir = '../../uploads/';

// جلب المستخدمين والتصنيفات
try {
    $users = $conn->query("SELECT id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
    $categories = $conn->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    $users = [];
    $categories = [];
}

// الحصول على post id
$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    die("No post ID provided");
}

// جلب بيانات البوست القديم
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute([':id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
    $excerpt = filter_input(INPUT_POST, 'excerpt', FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = $_POST['category_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if (!is_dir($uploadsdir)) {
        mkdir($uploadsdir, 0777, true);
    }

  // رفع صورة جديدة إن وجدت
if (!empty($_FILES['image']['name'])) {
    // لو فيه صورة قديمة نحذفها
    if (!empty($post['image']) && file_exists($uploadsdir . $post['image'])) {
        unlink($uploadsdir . $post['image']);
    }

    // تجهيز اسم الصورة الجديدة
    $imageName = time() . '_' . basename($_FILES['image']['name']);
    $imagePath = $uploadsdir . $imageName;

    // رفع الصورة الجديدة
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
} else {
    // لو ما رفع صورة، نخلي القديمة كما هي
    $imageName = $post['image'];
}


    // تعديل البوست
    $stmt = $conn->prepare("UPDATE posts 
        SET title = :title, excerpt = :excerpt, content = :content, image = :image, user_id = :user_id
        WHERE id = :id");

    $stmt->execute([
        ':title' => $title,
        ':excerpt' => $excerpt,
        ':content' => $content,
        ':image' => $imageName,
        ':user_id' => $user_id,
        ':id' => $post_id
    ]);

    // تحديث التصنيف
    if ($category_id) {
        $conn->prepare("DELETE FROM post_category WHERE post_id = :post_id")
             ->execute([':post_id' => $post_id]);

        $stmt2 = $conn->prepare("INSERT INTO post_category (post_id, category_id) VALUES (:post_id, :category_id)");
        $stmt2->execute([
            ':post_id' => $post_id,
            ':category_id' => $category_id,
        ]);
    }
    $_SESSION['success'] = "✅ Post updated successfully!";

    header('Location: index.php');
    exit;
}
?>

<?php include '../../components/dashboard/head.php' ?>

<body>
    <?php include '../../components/dashboard/slidebar.php' ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Post</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" class="form-control" id="title" placeholder="Enter post title">
                            </div>
                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" style="min-height: 200px;" id="content" placeholder="Write your post...">
                                    <?= htmlspecialchars($post['content']) ?></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="user_id" class="form-label">User</label>
                                <select class="form-select" id="user_id" name="user_id">
                                    <option disabled>Select user</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>" <?= $user['id'] == $post['user_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($user['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option disabled>Select category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="excerpt" class="form-label">Excerpt</label>
                                <input type="text" name="excerpt" value="<?= htmlspecialchars($post['excerpt']) ?>" class="form-control" id="excerpt" placeholder="Short summary">
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="bi bi-image me-1"></i> Featured Image
                                </label>
                                <input class="form-control" name="image" type="file" id="image">
                                <?php if ($post['image']): ?>
                                    <div class="mt-2">
                                        <img src="../../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Old Image" style="max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../components/dashboard/script.php' ?>
</body>
</html>
