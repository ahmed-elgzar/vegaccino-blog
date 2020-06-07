<?php
	include ("includes/config.php");
	include ("inc/header.php");
	$id = $_GET['id'];
	$query = "SELECT * FROM posts WHERE id = '$id'";
	$res   = mysqli_query($con, $query);

	$row = mysqli_fetch_assoc($res);
?>

<!-- start content -->
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<?php
							$id = $_GET['id'];
							$query = "SELECT * FROM posts WHERE id = '$id'";
							$res   = mysqli_query($con, $query);

							$row = mysqli_fetch_assoc($res);
						?>
						<div class="post">
							<div class="post-image">							
								<img src="imgs/<?php echo $row['postImg']; ?>" alt="img 1">
							</div>
							<div class="post-title">
								<h4><?php echo $row['postTitle']; ?></h4>
							</div>
							<div class="post-details">
								<div class="post-info">
									<span><i class="fa fa-user"></i><?php echo $row['postAuthor']; ?></span>
									<span><i class="fa fa-calendar-alt"></i><?php echo $row['postDate']; ?></span>
									<span><i class="fa fa-tags"></i><?php echo $row['postCat']; ?></span>
								</div>
								<p class="post-content">
									<?php 
										echo $row['postContent'];
									?>
								</p>
							</div>
						</div>
					</div>
					

<?php
	include ("inc/footer.php");
?>