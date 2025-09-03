<?php
session_start();
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

$conn = require '../../includes/db.php';
$categories = [];
if ($conn) {
    $stmt = $conn->query('
   SELECT *
        FROM categories 
      
');
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>
<?php include '../../components/dashboard/head.php' ?>

<body>
    <!-- Sidebar -->
    <?php include '../../components/dashboard/slidebar.php' ?>
    <div id="content">
        <?php include '../../components/dashboard/topbar.php' ?>
        <!-- Product Delivery and Stock Report -->
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All categories</h5>
                        <div class="d-flex">
                            <div class="dropdown me-2">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                    id="changeByDropdown" data-bs-toggle="dropdown">
                                    Change by: All
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                </ul>
                            </div>
                            <div class="dropdown me-2">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                    id="statusDropdown" data-bs-toggle="dropdown">
                                    Status: All
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">Active</a></li>
                                    <li><a class="dropdown-item" href="#">Inactive</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-light">
                                View Stock Items
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name of category</th>
                                         <th>Actions</th>

                                      


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="fw-semibold"><?php echo $category['name'] ?></span>
                                                </div>
                                            </td>
                                           <td>
                                                <a href="../../view/category/update.php?id=<?= $category['id'] ?>"
                                                    class="btn btn-sm btn-outline-success mb-2">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a href="../../view/category/delete.php?id=<?= $category['id'] ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </td>
                                                </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-muted">Showing 6 out of 50 Results</span>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item active" aria-current="page"><a class="page-link "
                                            href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../components/dashboard/script.php' ?>
</body>

</html>