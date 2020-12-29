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
$sql="SELECT * FROM tintuc ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ TIN TỨC</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
	<td>Mã Tin tức</td>
	<td>Tên Tin tức</td>
	<td>Mô tả</td>
	<td>Thao tác</td>
	<td>Thao tác</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	?>
	<tr>
		<td><?php echo $value['matintuc']?></td>
		<td><?php echo $value['tentintuc']?></td>
		<td><?php echo $value['mota']?></td>
			<td>
			<a href="xoa.php?matintuc=<?php echo $value['matintuc'] ?>">Xoá Tin tức</a>

		</td>	<td>
			<a href="capnhat.php?matintuc=<?php echo $value['matintuc'] ?>">Cập nhật Tin tức</a>

		</td>
		
	</tr>
	<?php
}
?>
<form method="post" enctype="multipart/form-data" >Mã Tin tức <input type="text" name="matintuc"><br>Tên Tin tức<input type="text" name="tentintuc"><br>Mô tả<input type="textarea" name="mota"><br>Thêm Tin tức<input type="submit" value="Thêm" name="them">
</table>
</div>
</body>
<?php 
if (isset($_POST['them']))
{
function postIndex($i, $v='')
{
	return isset($_POST[$i])?$_POST[$i]:$v;
}
$taikhoanadmin=$_SESSION['taikhoan'];
$data =[
	postIndex('matintuc'),
	postIndex('tentintuc'),
	postIndex('mota'),
	$taikhoanadmin
];
	$sql="insert into tintuc(matintuc, tentintuc, mota, taikhoanadmin)
	values(?, ?, ?, ?)";
$stm= $obj->prepare($sql);
$stm->execute($data);
header('location:quanly_tintuc.php');
}
