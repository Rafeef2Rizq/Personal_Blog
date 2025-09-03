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