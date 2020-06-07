<?php
	include("includes/config.php");
	include("includes/header.php");
	error_reporting(0);
	session_start();
		$cName  = $_POST['category'];
		$cAdd   = $_POST['add'];
		$id     = $_GET['id'];
		$sub    = $_GET['subid'];
	if(!isset($_SESSION['id'])){
		echo "<div class='alert alert-danger'>" . "غير مسموح لك بتصفح هذه الصفحة مباشرة" . "</div>";
		header('REFRESH:2;URL=login.php');
	}else{
		include("includes/sidebar.php");

	if(isset($id)){
		$query = "DELETE FROM catigories WHERE id = '$id'";
		$delete = mysqli_query($con,$query);
	}
	
	if(isset($sub)){
	    $query = "DELETE FROM subCat WHERE subID = '$sub'";
	    $delete = mysqli_query($con, $query);
	}

	if (isset($cAdd)){
		if(empty($cName)){
			echo "<div class='alert alert-danger'>" . "حقل التصنيف فارغ" . "</div>";
		}elseif($cName > 100){
			echo "<div class='alert alert-danger'>" ."اسم التصنيف كبير جدا" . "</div>";
		}else{
			$query = "INSERT INTO catigories(catigoryName) VALUES ('$cName')";
			mysqli_query($con, $query);
			echo "<div class='alert alert-success'>" ."تمت اضافة تصنيف جديد" . "</div>";
		}
	}
?>
					<div class="add-category">
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group">
								<label for="category">تصنيف جديد</label>
								<input type="text" name="category" class="form-control">
							</div>
							<button class="btn-custom form-control" name="add">إضافة</button>
						</form>
					</div>
					<div class="display-cat-mt-5">
						<?php

						if(isset($delete)){
							echo "<div class='alert alert-success mt-2'>" . "تم حذف التصنيف بنجاح" . "</div>";
						}
						?>
						<table class="table table-ordered">
							<thead>
								<tr>
								<th>رقم الفئة</th>
								<th>إسم الفئة</th>
								<th>تاريخ الاضافة</th>
								<th>حذف المقال</th>
							</tr>
							</thead>
							<?php
								$query = "SELECT * FROM catigories ORDER BY id DESC";
								$res = $con -> query($query);
								$no = 0;
								while($row = mysqli_fetch_assoc($res)){
									$no++
							?>
							<tbody>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $row['catigoryName']; ?></td>
									<td><?php echo $row['catigoryTime']; ?></td>
									<td><a href="catigories.php?id=<?php echo $row['id']; ?>"><button class="btn-custom">حذف</button></a></td>
								</tr>
							</tbody>
							<?php
							}
							?>
						</table>
					</div>
					<div class="add-category">
						<?php
							if($_SERVER['REQUEST_METHOD'] == 'POST'){
								$subN = $_POST['cCategory'];
								$subC = $_POST['subCatigory'];
								if(empty($subN)){
									echo "<div class='alert alert-danger'>" . "لايمكمك ترك هذا الحقل فارغ" . "</div>";
								}else{
									$query = "INSERT INTO subCat(subN, subC) VALUES ('$subN', '$subC')";
									mysqli_query($con, $query);
									echo "<div class='alert alert-success'>" ."تمت اضافة تصنيف فرعي جديد" . "</div>";
								}
							}
						?>
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group">
								<label for="cCategory">تصنيف فرعي جديد</label>
								<input type="text" name="cCategory" class="form-control" placeholder="اسم التصنيف الفرعي">
							</div>
							<div class="form-group">
								<label for="pCategory">تابع لـ</label>
								<select id="pCategory" name="subCatigory" class="form-control">
									<?php
										$query = "SELECT * FROM catigories";
										$res = mysqli_query($con,$query);
										while($row = mysqli_fetch_assoc($res)){
									?>
									<option>
										<?php echo $row['catigoryName']; ?>
									</option>
									<?php
									}
									?>
								</select>
							</div>
							<input type="submit" class="btn-custom form-control" name="save" value="إضاقة">
						</form>
					</div>
					<div class="display-cat-mt-5">
						<?php

						if(isset($delete)){
							echo "<div class='alert alert-success mt-2'>" . "تم حذف التصنيف بنجاح" . "</div>";
						}
						?>
						<table class="table table-ordered">
							<thead>
								<tr>
								<th>رقم الفئة</th>
								<th>إسم الفئة</th>
								<th>تابع لـ</th>
								<th>تاريخ الاضافة</th>
								<th>حذف المقال</th>
							</tr>
							</thead>
							<?php
								$query = "SELECT * FROM subCat ORDER BY subID DESC";
								$res = mysqli_query($con,$query);
								$no = 0;
								while($row = mysqli_fetch_assoc($res)){
									$no++
							?>
							<tbody>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $row['subN']; ?></td>
									<td><?php echo $row['subC']; ?></td>
									<td><?php echo $row['subT']; ?></td>
									<td><a href="catigories.php?subid=<?php echo $row['subID']; ?>"><button class="btn-custom">حذف</button></a></td>
								</tr>
							</tbody>
							<?php
							}
							?>
						</table>
					</div>
				</div>
<?php
	}
	include("includes/footer.php")
?>