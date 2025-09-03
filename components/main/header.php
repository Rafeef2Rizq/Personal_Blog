	<?php
$conn = require 'includes/db.php';

// جلب التصنيفات
$stmt = $conn->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

	
	<header id="header">
						<h1><a href="index.html">Future Imperfect</a></h1>
						<nav class="links">
							<ul>
								<?php foreach($categories as $category): ?>
								<li><a href="#"><?php echo $category['name'] ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
						<nav class="main">
							<ul>
								<li class="search">
									<a class="fa-search" href="#search">Search</a>
									<form id="search" method="get" action="/index.php">
										<input type="text" name="search_query" placeholder="Search" />
									</form>
								</li>
								<li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>
							</ul>
						</nav>
					</header>