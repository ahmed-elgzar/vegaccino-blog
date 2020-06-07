<?php
	include("includes/config.php");
	include("includes/header.php");
	session_start();
	error_reporting(0);
	$pTitle 	= $_POST['postTitle'];
	$pCat   	= $_POST['postCat'];
	$pContent 	= $_POST['content'];
	$se  = $_SESSION['id'];
	$query = "SELECT name FROM admins WHERE id = '$se'";
	$res = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($res);
	$postAuthor = $row['name'];
	$postAdd 	= $_POST['save'];
	$imageName 	= $_FILES['postImg']['name'];
	$imageTmp 	= $_FILES['postImg']['tmp_name'];

	if(!isset($_SESSION['id'])){
		echo "<div class='alert alert-danger'>" . "غير مسموح لك بتصفح هذه الصفحة مباشرة" . "</div>";
		header('REFRESH:2;URL=login.php');
	}else{
		include("includes/sidebar.php");

	if(isset($postAdd)){
		if(empty($pTitle || $pContent)){
			echo "<div class='alert alert-danger mt-2'>" . "لايمكنك ترك الحقول فارغة" . "</div>";
		}elseif($pContent > 1000){
			echo "<div class='alert alert-danger'>" . "هذا المنشور كبير جدا" . "</div>";
		}else{
			$postimage = rand(0,1000)."_".$imageName;
			move_uploaded_file($imageTmp, "imgs/" . $postimage);

			$query ="INSERT INTO posts (postTitle,postCat,postImg,postContent,postAuthor) VALUES ('$pTitle','$pCat','$postimage','$pContent','$postAuthor')";

			$res = mysqli_query($con,$query);

			if(isset($res)){
				echo "<div class='alert alert-success'>" . "تمت إضافة المنشور بنجاح" . "</div>";
			}else{
				echo "<div class='alert alert-danger'>" . "حدث خطأ ما" . "</div>";
			}
		}
	}
?>
					<div class="add-category">
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="category">عنوان المقال</label>
								<input type="text" name="postTitle" class="form-control">
							</div>
							<div class="form-group">
								<label for=cate>التصنيف</label>
								<select name="postCat" id="cate" class="form-control">
									<?php
										$query = "SELECT * FROM catigories";
										$res = mysqli_query($con,$query);
										$q = "SELECT subN FROM subCat";
										$r = mysqli_query($con, $q);
										while($row = mysqli_fetch_assoc($res)){
									?>
										<option>
											<?php echo $row['catigoryName']; ?>
										</option>
									<?php
										}
										while($ro = mysqli_fetch_assoc($r)){
									?>
										<option>
											<?php echo $ro['subN']; ?>
										</option>
									<?php
										}
									?>	
								</select>
							</div>
							<div class="form-group">
								<label for="image">صورة المقال</label>
								<input type="file" name="postImg" id="image" class="form-control">
							</div>
							<div class="form-group">
								<label for="content">نص المقال</label>
								<textarea id="" cols="30" rows="10" class="form-control ckeditor" name="content"></textarea>
							</div>
							<button class="btn-custom form-control" name="save">نشر المقال</button>
						</form>
					</div>
<?php
	}
	include("includes/footer.php");
?>