	<div class="col-md-3">
						<!-- Catagories -->
						
						<div class="categories">
							<h4>التصنيفات</h4>
							<?php
							$query 		= "SELECT catigoryName FROM catigories";
							$res 		= mysqli_query($con, $query);
							while($row  = mysqli_fetch_assoc($res)){
						?>
							<ul>
								<li data-toggle="collapse" data-target="#me">
									<a href="catigory.php?catigory=<?php echo $row['catigoryName']; ?>">
										<span><i class="<?php
											$fo = $row['catigoryName'];
											if($fo == "وصفات"){
												echo "fas fa-utensils";
											}elseif($fo == "عن النظام النباتي"){
												echo "fas fa-carrot";
											}elseif($fo == "تجارب شخصية"){
												echo "fas fa-users";
											}else{
												echo "fas fa-tags";
											}
										?>"></i></span>
										<span><?php echo $row['catigoryName']; ?> </span>
										<span><i class="fas fa-sort-down" style="float: left;"></i></span>
									</a>
								</li>
								<?php
									$subc 	= $row['catigoryName'];
									$q 		= "SELECT subN FROM subCat WHERE subC = '$subc'";
									$re 	= mysqli_query($con, $q);
									if(isset($re)){
										while ($ro = mysqli_fetch_assoc($re)) {
								?>
								<ul class="collapse" id="me">
									<li>
										<a href="catigory.php?catigory=<?php echo $ro['subN']; ?>">
											<span><i class="fas fa-tags"></i></span>
											<span><?php echo $ro['subN']; ?></span>
										</a>
									</li>
								</ul>
							</ul>
							<?php
										}
									}
							}
							?>
						</div>
						<!-- End catigories -->
						<!-- start latest posts -->
							<div class="last-posts">
								<h4>أحدث المشورات</h4>
								<?php
									$query = "SELECT id, postImg, postTitle FROM posts ORDER BY id DESC LIMIT 3";
									$res   = mysqli_query($con, $query);

									while ($row = mysqli_fetch_assoc($res)) {
								?>	
								<ul>
									<li>
										<a href="post.php?id=<?php echo $row['id']; ?>">
											<span class="span-image"><img src="imgs/<?php echo $row['postImg']; ?>" width="70px" hight="50px"></span>
											<span><?php echo $row['postTitle']; ?></span>
									</li>
								</ul>
								<?php
									}
								?>
							</div>
						<!-- end latest posts -->
                        </div>
					</div>
				</div>
			</div>
		</div>
	<!-- end content -->
	<footer>
		<p>جميع الحقوق محفوظة &copy; 2020</p>
	</footer>

	<script src="js/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/03757ac844.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>