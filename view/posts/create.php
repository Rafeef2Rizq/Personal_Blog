<?php

$conn = require '../../includes/db.php';
$uploadsdir = '../../uploads/';
try {
    $users = $conn->query("SELECT id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
    $categories = $conn->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    $users = [];
    $categories = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
    $excerpt = filter_input(INPUT_POST, 'excerpt', FILTER_SANITIZE_SPECIAL_CHARS);
    $created_at = date('Y-m-d H:i:s');
    $category_id = $_POST['category_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if (!is_dir($uploadsdir)) {
        mkdir($uploadsdir, 0777, true);
    }
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadsdir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imageName = null;
    }
    $stmt = $conn->prepare("INSERT INTO posts (title, excerpt, content, image, created_at, user_id) VALUES (:title, :excerpt, :content, :image, :created_at, :user_id)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':excerpt', $excerpt);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $imageName);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':user_id', $user_id);

    $stmt->execute();
    $post_id = $conn->lastInsertId();
    if ($category_id) {
        $stmt2 = $conn->prepare("
            INSERT INTO post_category (post_id, category_id)
            VALUES (:post_id, :category_id)
        ");
        $stmt2->execute([
            ':post_id' => $post_id,
            ':category_id' => $category_id,
        ]);
    }


    header('Location: index.php');
}
?>
<?php include '../../components/head.php' ?>

<body>
    <!-- Sidebar -->
    <?php include '../../components/slidebar.php' ?>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h3 class="mb-0 text-white"><i class="bi bi-pencil-square me-2 text-white"></i>Create New Post</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter post title">
                            </div>
                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" style=" min-height: 200px;" id="content" placeholder="Write your post..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="user_id" class="form-label">User</label>
                                <select class="form-select" id="user_id" name="user_id">
                                    <option selected disabled>Select user id</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="mb-4">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option selected disabled>Select category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="excerpt" class="form-label">Excerpt</label>
                                <input type="text" name="excerpt" class="form-control" id="excerpt" placeholder="Short summary">
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="bi bi-image me-1"></i>Featured Image
                                </label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Create Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../components/script.php' ?>
</body>

</html>