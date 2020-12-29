<?php 
session_start();
if(isset($_SESSION["taikhoan"]) &&$_SESSION["admin"]==2)
{
	echo '<h3 style="color:yellow;">Chào - '. $_SESSION["taikhoan"]
	.'---'.'<a href="logout.php">Đăng xuất</a>'
	.'---' .'<a href="quanly_admin2.php">Quay lại</a>';
}
else
{
	header('location:index.php');
}
?>
<?php
include"connect.php";
$sql="SELECT * FROM khachhang ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ SÁCH</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="templatemo_quanlysach">
<table border="1">
<tr>
	<td>Họ tên</td>

	<td>Tài Khoản</td>
	<td>Mật Khẩu</td>
	<td>Thao Tác</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	?>
	<tr>
		
		<td><?php echo $value['hoten']?></td>
		<td><?php echo $value['taikhoan']?></td>
		<td><?php echo $value['matkhau']?></td>
		<td><a href="xoa.php?taikhoankhachhang=<?php echo $value['taikhoan'] ?>">
			Xoá Khách Hàng</a></td>
			
	
	</tr>
	<?php
}
?>
</table>
</div>
</body>