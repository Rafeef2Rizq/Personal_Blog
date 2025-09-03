<?php
session_start();

$conn = require '../../includes/db.php';

// الحصول على category id
$category_id = $_GET['id'] ?? null;
if (!$category_id) {
    die("No category ID provided");
}

// جلب بيانات البوست القديم
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->execute([':id' => $category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die("Category not found");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmt = $conn->prepare("UPDATE  categories set name=:name where id=:id");
    $stmt->bindParam(':id', $category_id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    
    $_SESSION['success'] = "✅ Category updated successfully!";

    header('Location: index.php');
}
?>

<?php include '../../components/dashboard/head.php' ?>

<body>
    <!-- Sidebar -->
    <?php include '../../components/dashboard/slidebar.php' ?>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h3 class="mb-0 text-white"><i class="bi bi-pencil-square me-2 text-white"></i>Create New Category</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control"
                                value="<?php echo $category['name'] ?>" name="name" id="name" placeholder="Enter category name">
                            </div>
                        
                         
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Update Category
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