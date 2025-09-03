<?php
session_start();
$conn = require 'includes/db.php';
$uploadsdir = '../../uploads/';
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

<?php include 'components/main/head.php'; ?>


<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<?php include 'components/main/header.php'; ?>


		<!-- Menu -->
				<?php include 'components/main/menu.php'; ?>


		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<?php foreach ($posts as $post): ?>
				<article class="post">
					<header>
						<div class="title">
							<h2><a href="single_post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h2>
							<p><?php echo $post['excerpt'] ?></p>
						</div>
						<div class="meta">
							<time class="published" datetime="<?php echo $post['created_at']; ?>">
								<?php echo date('F j, Y', strtotime(datetime: $post['created_at'])); ?>
							</time>
							<a href="#" class="author"><span class="name"><?php echo $post['author_name'] ?></span><img src="public/images/avatar.jpg" alt="" />
							</a>
						</div>
					</header>
					<a href="single_post.php?id=<?php echo $post['id'] ?>" style="height: 300px;object-fit: contain;" class="image featured"><img src="<?php echo $uploadsdir . $post['image']; ?>" alt="" /></a>
					<p><?php echo excerpt($post['content'], 10) ?></p>
					<footer>
						<ul class="actions">
							<li><a href="single_post.php?id=<?php echo $post['id'] ?>" class="button large">Continue Reading</a></li>
						</ul>
						<ul class="stats">
							<li><a href="#">General</a></li>
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
								<a href="single.html" class="image"><img src="<?php echo $uploadsdir . $post['image']; ?>" alt="" /></a>
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
				<?php include 'components/main/footer.php'; ?>


	</div>

	<!-- Scripts -->
	<?php include 'components/main/script.php'; ?>


</body>

</html>