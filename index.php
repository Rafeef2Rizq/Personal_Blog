<?php
session_start();
$conn = require 'includes/db.php';
$start = 0;
$posts_per_page = 3;
//Search Functionality
$search_query=isset($_GET['search_query']) ? $_GET['search_query'] : '';

$whereSql = "WHERE title LIKE :kw OR content LIKE :kw";
$countStmt = $conn->prepare("SELECT COUNT(*) FROM posts $whereSql");
$kw = "%".$search_query."%";
$countStmt->bindValue(':kw', $kw, PDO::PARAM_STR);
$countStmt->execute();
$total_records = $countStmt ->fetchColumn();
$pages = ceil($total_records / $posts_per_page);
if (isset($_GET["page_nr"])) {
	$page = $_GET["page_nr"] - 1;
	// get new starting points 
	$start = $page * $posts_per_page;
}

$posts = [];
if ($conn) {
$stmt = $conn->prepare("SELECT posts.*, users.username AS author_name 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE title LIKE ? OR content LIKE ? 
    ORDER BY posts.created_at DESC 
    LIMIT ?, ?");

$stmt->bindValue(1, $kw, PDO::PARAM_STR);
$stmt->bindValue(2, $kw, PDO::PARAM_STR);
$stmt->bindValue(3, $start, PDO::PARAM_INT);
$stmt->bindValue(4, $posts_per_page, PDO::PARAM_INT);


	$stmt->execute();
	$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function excerpt($text, $limit = 10)
{
	$words = explode(" ", strip_tags($text));
	$excerpt = implode(" ", array_slice($words, 0, $limit));
	return $excerpt . (count($words) > $limit ? "..." : "");
}


?>

<html>

<head>
	<title>Personal Blog</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="public/assets/css/main.css" />
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="index.html">Personal Blog</a></h1>
			<nav class="links">
				<ul>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Feugiat</a></li>
					<li><a href="#">Tempus</a></li>
					<li><a href="#">Adipiscing</a></li>
				</ul>
			</nav>
			<nav class="main">
				<ul>
					<li class="search">
						<a class="fa-search" href="#search">Search</a>
						<form id="search" method="get" action="search.php">
							<input type="text" name="search_query" placeholder="Search" />
						</form>
					</li>
					<li class="menu">
						<a class="fa-bars" href="#menu">Menu</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Menu -->
		<section id="menu">

			<!-- Search -->
			<section>
				<form class="search" method="get" action="#">
					<input type="text" name="query" placeholder="Search" />
				</form>
			</section>

			<!-- Links -->
			<section>
				<ul class="links">
					<?php foreach($posts as $post): ?>
					<li>
						<a href="#">
							<h3><?php echo $post['title'] ?></h3>
							<p><?php echo $post['excerpt'] ?><</p>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</section>

			<!-- Actions -->
			<section>
				<ul class="actions stacked">
					<?php if (isset($_SESSION['user_id'])): ?>
						<!-- يظهر إذا المستخدم مسجل دخول -->
						<li><a href="dashboard.php" class="button large fit">Dashboard</a></li>
						<li><a href="public/logout.php" class="button large fit">Log Out</a></li>
					<?php else: ?>
						<!-- يظهر إذا المستخدم غير مسجل دخول -->
						<li><a href="public/login.php" class="button large fit">Log In</a></li>
					<?php endif; ?>
				</ul>
			</section>


		</section>

		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<?php foreach ($posts as $post): ?>
				<article class="post">
					<header>
						<div class="title">
							<h2><a href="single.html"><?php echo $post['title'] ?></a></h2>
							<p><?php echo $post['excerpt'] ?></p>
						</div>
						<div class="meta">
							<time class="published" datetime="<?php echo $post['created_at']; ?>">
								<?php echo date('F j, Y', strtotime($post['created_at'])); ?></time>
							<a href="#" class="author"><span class="name"><?php echo $post['author_name'] ?></span><img src="public/images/avatar.jpg" alt="" />
							</a>
						</div>
					</header>
					<a href="single.html" style="height: 300px;" class="image featured"><img src="../../uploads/<?php echo $post['image'] ?>" alt="" /></a>
					<p><?php echo excerpt($post['content'], 10) ?></p>
					<footer>
						<ul class="actions">
							<li><a href="single.html" class="button large">Continue Reading</a></li>
						</ul>
						<ul class="stats">
							<li><a href="#">General</a></li>
							<li><a href="#" class="icon solid fa-heart">28</a></li>
							<li><a href="#" class="icon solid fa-comment">128</a></li>
						</ul>
					</footer>
				</article>

			<?php endforeach; ?>

			<!-- Pagination -->
			<ul class="actions pagination">
				<?php if (isset($_GET['page_nr']) && $_GET['page_nr'] > 1) {	 ?>
					<li><a href="?page_nr=<?php echo $_GET['page_nr'] - 1 ?>" class=" button large previous">Previous Page</a></li>
				<?php } else {  ?>
					<li><a href="" class="disabled button large previous">Previous Page</a></li>
				<?php }  ?>
				<!-- Next -->
				<?php if (!isset($_GET['page_nr'])): ?>
					<li><a href="?page_nr=2" class="button large next">Next Page</a></li>
				<?php elseif ($_GET['page_nr'] >= $pages): ?>
					<li><a href="#" class="disabled button large next">Next Page</a></li>
				<?php else: ?>
					<li><a href="?page_nr=<?php echo $_GET['page_nr'] + 1 ?>" class="button large next">Next Page</a></li>
				<?php endif; ?>

			</ul>

		</div>

		<!-- Sidebar -->
		<section id="sidebar">

			<!-- Intro -->
			<section id="intro">
				<a href="#" class="logo"><img src="public/images/logo.jpg" alt="" /></a>
				<header>
					<h2>Personal Blog</h2>

					<p> I am <a href=""><?php echo $_SESSION['username'] ?? 'Guest'; ?></a></p>
				</header>
			</section>


			<!-- Posts List -->
			<section>
				<ul class="posts">
					<?php foreach ($posts as $post): ?>
						<li>
							<article>
								<header>
									<h3><a href="single.html"><?php echo $post['title'] ?></a></h3>
									<time class="published" datetime="<?php echo $post['created_at'] ?>">
										<?php echo date('F j, Y', strtotime($post['created_at'])); ?>
									</time>
									<a href="#" class="author"><span class="name"><?php echo $post['author_name'] ?></span><img src="public/images/avatar.jpg" alt="" /></time>
								</header>
								<a href="single.html" class="image"><img src="../../uploads/<?php echo $post['image'] ?>" alt="" /></a>
							</article>
						</li>
					<?php endforeach; ?>

				</ul>
			</section>

			<!-- About -->
			<section class="blurb">
				<h2>About</h2>
				<p>Look at my content</p>
				<ul class="actions">
					<li><a href="/view/profile.php" class="button">Learn More</a></li>
				</ul>
			</section>

			<!-- Footer -->
			<section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
					<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<p class="copyright">&copy; Dveloped by <a href="">Rafeef Rezeq</a></p>
			</section>

		</section>

	</div>

	<!-- Scripts -->
	<script src="public/assets/js/jquery.min.js"></script>
	<script src="public/assets/js/browser.min.js"></script>
	<script src="public/assets/js/breakpoints.min.js"></script>
	<script src="public/assets/js/util.js"></script>
	<script src="public/assets/js/main.js"></script>

</body>

</html>