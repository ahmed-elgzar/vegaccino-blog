<?php
	include("includes/config.php");
	include("includes/header.php");
	session_start();
	error_reporting(0);
	if(!isset($_SESSION['id'])){
		echo "<div class='alert alert-danger'>" . "غير مسموح لك بتصفح هذه الصفحة مباشرة" . "</div>";
		header('REFRESH:2;URL=login.php');
	}else{
		include("includes/sidebar.php");
	
	$id = $_GET['id'];


	if(isset($id)){
		$query = "DELETE FROM posts WHERE id = '$id'";
		$delete = mysqli_query($con, $query);

		if($delete){
			echo "<div class='alert alert-success mt-3'>" . "تم حذف المقال" . "</div>";
		}else{
			echo "<div class='alert alert-danger mt-3'>" . "عفوا حدث خطأ ما" . "</div>";
		}
	}
?>

<!-- Display all posts -->
<div class="display-posts mt-4">
	<table class="table table-ordered">
		<thead>
			<tr>
				<th>رقم المقال</th>
				<th>عنوان المقال</th>
				<th>كاتب المقال</th>
				<th>صورة المقال</th>
				<th>تاريخ المقال</th>
				<th>حذف المقال</th>
			</tr>
		</thead>
		<?php
			$query = "SELECT * FROM posts ORDER BY id DESC";
			$res = mysqli_query($con, $query);
			$no = 0;

			while($row = mysqli_fetch_assoc($res)){
				$no++;
		?>
		<tr>

			<td><?php echo $no; ?></td>
			<td><?php echo $row['postTitle']; ?></td>
			<td><?php echo $row['postAuthor']; ?></td>
			<td><img src="imgs/<?php echo $row['postImg']; ?>" width="70px" hight="50px"></td>
			<td><?php echo $row['postDate']; ?></td>
			<td><a href="posts.php?id=<?php echo $row['id']; ?>"><button class="btn-custom">حذف</button></a></td>
		</tr>
		<?php
			}
		?>
	</table>
</div>
<?php
	}
	include("includes/footer.php");
?>