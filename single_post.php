<?php include 'components/main//head.php';
$conn = include 'includes/db.php';
$uploadsdir = '../../uploads/';
$stmt = $conn->prepare('SELECT posts.*, users.username AS author_name 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = :id');
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    header('Location: index.php');
    exit;
}


?>

<body class="single is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <?php include 'components/main/header.php'; ?>

        <!-- Menu -->
        <?php include 'components/main/menu.php'; ?>

        <!-- Main -->
        <div id="main">

            <!-- Post -->
            <article class="post">
                <header>
                    <div class="title">
                        <h2><a href="#"><?php echo $post['title'] ?></a></h2>
                        <p><?php echo $post['excerpt'] ?> </p>
                    </div>
                    <div class="meta">
                        <time class="published" datetime="<?php echo $post['created_at'] ?>">
                            <?php echo date('F j, Y', strtotime(datetime: $post['created_at'])); ?>

                        </time>
                        <a href="#" class="author"><span class="name"><?php echo $post['author_name'] ?></span><img src="<?php echo $uploadsdir . $post['image']; ?>" alt="" /></a>
                    </div>
                </header>
                <span class="image featured"><img src="<?php echo $uploadsdir . $post['image']; ?>" style="height: 500px;  object-fit: cover;" alt="" /></span>
                  <p><?php echo $post['content'] ?></p>   
                   <footer>
                    <ul class="stats">
                        <li><a href="#">General</a></li>
                        <li><a href="#" class="icon solid fa-comment">128</a></li>
                    </ul>
                </footer>
            </article>

        </div>

        <!-- Footer -->
        <?php include 'components/main/footer.php'; ?>


    </div>

    <!-- Scripts -->
    <?php include 'components/main/script.php'; ?>


</body>

</html>