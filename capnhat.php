<?php 
include'connect.php';
$masach = isset($_GET['masach'])?($_GET['masach']):'';
$maloai =isset($_GET['maloai'])?($_GET['maloai']):'';
$matacgia= isset($_GET['matacgia'])?($_GET['matacgia']):'';
$makhuyenmai=isset($_GET['makhuyenmai'])?($_GET['makhuyenmai']):'';
$mabanner=isset($_GET['mabanner'])?($_GET['mabanner']):'';
$matintuc=isset($_GET['matintuc'])?($_GET['matintuc']):'';
$sql="SELECT * FROM sach ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
$stm = $obj->query('select * from loai');
$data1 = $stm->fetchAll();
$stm = $obj->query('select * from tacgia');
$data2 = $stm->fetchAll();
$sql="SELECT * FROM tintuc ";
$stm=$obj->query($sql);
$data3=$stm->fetchAll();
if($masach != '')
{  ?><form method="post" enctype="multipart/form-data" >Tên sách<input type="text" name="tensach"><br>Mô tả <input type="textarea" name="mota"><br>Giá<input type="text" name="gia"> <br>Hình <input type="file" name="hinh" title=" "> <br>Thể loại<select name="maloai">			
					<?php 
					foreach ($data1 as $key => $value) {
						?>
						
						<option value="<?php echo $value['maloai'] ?>">
							<?php echo $value['tenloai'] ?>
						</option>
						<?php
					}
					?>
				</select>
				<br>Tác giả<select name="matacgia">			
					<?php 
					foreach ($data2 as $key => $value) {
						?>
						
						<option value="<?php echo $value['matacgia'] ?>">
							<?php echo $value['hoten'] ?>
						</option>
						<?php
					}
					?>
				</select>
				<br>Cập nhật sách<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$tensach=$_POST['tensach'];$mota=$_POST['mota'];$gia=$_POST['gia'];$hinh = $_FILES['hinh']['error']==0?$_FILES['hinh']['name']:'';$loai=$_POST['maloai'];$tacgia=$_POST['matacgia'];
	$sql="UPDATE sach SET tensach='$tensach',mota='$mota',gia='$gia',hinh='$hinh',maloai='$loai',matacgia='$tacgia',luotmua=0 WHERE masach='$masach'";
	$stm = $obj->prepare($sql);
		$stm->execute();
		header('location:quanly_sach.php');	
}
}
else if($maloai != '')
{ ?><form method="post" enctype="multipart/form-data" >Tên loại<input type="text" name="tenloai">
				<br>Cập nhật sách<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$tenloai=$_POST['tenloai'];
	$sql="UPDATE loai SET tenloai='$tenloai' WHERE maloai='$maloai'";
	$stm = $obj->prepare($sql);
		$stm->execute();
		header('location:quanly_loai.php');	
}
}
else if($matacgia != '')
{
	?><form method="post" enctype="multipart/form-data" >Tên tác giả <input type="text" name="tentacgia">
				<br>Cập nhật sách<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$tentacgia=$_POST['tentacgia'];
	$sql="UPDATE tacgia SET hoten='$tentacgia' WHERE matacgia='$matacgia'";
		$stm = $obj->prepare($sql);
		$stm->execute();
header('location:quanly_tacgia.php');	
}
}
else if($makhuyenmai !='')
{	?>
	<form method="post" enctype="multipart/form-data" >Tên khuyến mãi<input type="text" name="tenkhuyenmai">
				<br>Cập nhật khuyến mãi<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$tenkhuyenmai=$_POST['tenkhuyenmai'];
	$sql="UPDATE khuyenmai SET tenkhuyenmai='$tenkhuyenmai' WHERE makhuyenmai='$makhuyenmai'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_khuyenmai.php');	
}
}
else if($matintuc !='')
{
	?><form method="post" enctype="multipart/form-data" >Tên tin tức<input type="text" name="tentintuc"><br>Mô tả <input type="textarea" name="mota">
				<br>Cập nhật khuyemai<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$tentintuc=$_POST['tentintuc'];$mota=$_POST['mota'];
	$sql="UPDATE tintuc SET tentintuc='$tentintuc',mota='$mota' WHERE matintuc='$matintuc'";

	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_tintuc.php');	
}
}
else if($mabanner !='')
{	?><form method="post" enctype="multipart/form-data" >Hình <input type="file" name="hinh" title=" "> <br>Thuộc tin tức<select name="matintuc">			
					<?php 
					foreach ($data3 as $key => $value) {
						?>
						
						<option value="<?php echo $value['matintuc'] ?>">
							<?php echo $value['tentintuc'] ?>
						</option>
						<?php
					}
					?>
				</select>
				<br>Cập nhật banner<input type="submit" value="Thêm" name="capnhat"></form>
				<?php 
				if (isset($_POST['capnhat'])) {
				$hinh = $_FILES['hinh']['error']==0?$_FILES['hinh']['name']:'';$matintuc=$_POST['matintuc'];
	$sql="UPDATE banner SET hinh='$hinh',matintuc='$matintuc' WHERE mabanner='$mabanner'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_banner.php');	
}
}

