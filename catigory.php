<?php
	include ("includes/config.php");
	$header = $_GET['catigory'];
	include ("inc/header.php");
?>
	<!-- start content -->
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<?php
							$catigory = $_GET['catigory'];
							$sub = "SELECT subN FROM subCat WHERE subC = '$catigory'";
							$result = mysqli_query($con,$sub);
							$ro 	= mysqli_fetch_assoc($result);
							$nro	= $ro['subN'];
							$query = "SELECT * FROM posts WHERE '$nro' = postCat or '$catigory'= postCat";
							$res = mysqli_query($con,$query);


							while ($row = mysqli_fetch_assoc($res)){
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
										if(strlen($row['postContent']) > 150){
											$row['postContent'] = substr($row['postContent'], 0 , 300) . " ...";
											echo $row['postContent'];
										}
										?>
								</p>
								<a href="post.php?id=<?php echo $row['id']; ?>">
									<button class="btn btn-custom">إقرأ المزيد</button>
								</a>
							</div>
						</div>
					<?php
						}
					?>	
					</div>
<?php

	include ("inc/footer.php");
?>
