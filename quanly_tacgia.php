<?php 
session_start();
if(isset($_SESSION["taikhoan"])&&$_SESSION["admin"]==1)
{
	echo '<h3 style="color:yellow;">Chào - '. $_SESSION["taikhoan"]
	.'---'.'<a href="logout.php">Đăng xuất</a>'
	.'---' .'<a href="quanly_admin1.php">Quay lại</a>';

}
else
{
	header('location:index.php');
}
?>
<?php
include"connect.php";
$sql="SELECT * FROM tacgia ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ TÁC GIẢ</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
	<td>Mã tác giả</td>
	<td>Tên sach</td>
	<td>Xoá sach</td>
	<td>Cập nhật tác giả</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	?>
	<tr>
		<td><?php echo $value['matacgia']?></td>
		<td><?php echo $value['hoten']?></td>
			<td>
			<a href="xoa.php?matacgia=<?php echo $value['matacgia'] ?>">Xoá Tác Giả</a>

		</td>
		<td><a href="capnhat.php?matacgia=<?php echo $value['matacgia'] ?>">Cập nhật Tác Giả</a></td>
		
	</tr>
	<?php
}
?>
<form method="post" enctype="multipart/form-data" >Mã tác giả <input type="text" name="matacgia"><br>Tên tác giả<input type="text" name="hoten"><br>Thêm tác giả<input type="submit" value="Thêm" name="them">
</table>
</div>
</body>
<?php 
if (isset($_POST['them'])){
function postIndex($i, $v='')
{
	return isset($_POST[$i])?$_POST[$i]:$v;
}
$data =[
	postIndex('matacgia'),
	postIndex('hoten')];
	$sql="insert into tacgia(matacgia, hoten)
	values(?, ?)";
$stm= $obj->prepare($sql);
$stm->execute($data);
header('location:quanly_tacgia.php');

}
