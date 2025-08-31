<?php

$conn = require '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  

   
   
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    

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
                        <h3 class="mb-0 text-white"><i class="bi bi-pencil-square me-2 text-white"></i>Create New Category</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">
                            </div>
                        
                         
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Create Category
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