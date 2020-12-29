<?php 
session_start();
if(isset($_SESSION["taikhoan"])&&$_SESSION["admin"]==2)
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
$sql="SELECT * FROM phieunhap ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ PHIẾU NHẬP</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
    <td>Mã phiếu nhập</td>
	<td>Ngày nhập</td>
	<td>Thành tiền</td>
    <td>Người nhập</td>
</tr>
<form method="post" enctype="multipart/form-data" >Mã sách <input type="text" name="masach"><br>Tên sách<input type="text" name="tensach"><br>Giá<input type="text" name="gia">
<br>Số lượng <input type="text" name="soluong"><br>Thêm phiếu nhập <input type="submit" name="them" value="Thêm">
<?php 
foreach($data as $key=>$value)
{
	?>
	<tr>
		<td><?php echo $value['maphieunhap']?></td>
		<td><?php echo $value['ngaynhap']?></td>
		<td><?php echo $value['thanhtien']?></td>
        <td><?php echo $value['taikhoanadmin']?></td>

	</tr>
	<?php
}
if (isset($_POST['them']))
{
	function postIndex($i, $v='')
	{
	return isset($_POST[$i])?$_POST[$i]:$v;
	}
    $taikhoanadmin=$_SESSION['taikhoan'];
    $ngaynhap=date("Y/m/d");
	$data =[
	postIndex('mabanner'),
	$hinh,
	postIndex('matintuc'),
	$taikhoanadmin];
	$sql="insert into phieunhap(taikhoanadmin,ngaynhap,thanhtien)
	values(?, ?, ?)";
	$stm= $obj->prepare($sql);
	$stm->execute($data);
	header('location:quanly_phieunhap.php');}


