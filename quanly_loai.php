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
$sql="SELECT * FROM loai ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ LOẠI</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
	<td>Mã Loại</td>
	<td>Tên loại</td>
	<td>Thao tác</td>
	<td>Thao tác</td>
</tr>

<?php 

foreach($data as $key=>$value)
{

	?>
	<tr>
		<td><?php echo $value['maloai']?></td>
		<td><?php echo $value['tenloai']?></td>
		<td>
			<a href="capnhat.php?maloai=<?php echo $value['maloai'] ?>">Cập nhật Loại</a>
		</td>
		<?php 
		$sql="SELECT * FROM loai where maloai not in (select maloai from sach)";
		$stm=$obj->query($sql);
		$data1=$stm->fetchAll(); 
		foreach($data1 as $key=>$value1)
		{	if($value['maloai']==$value1['maloai'])
			{
				?>	<td><a href="xoa.php?maloai=<?php echo $value['maloai'] ?>">Xoá Loại</a> 
				</td> <?php
			}
		}
		?>	
		
		
	</tr>
	<?php
}
?>
<form method="post" enctype="multipart/form-data" >Mã Loại <input type="text" name="maloai"><br>Tên loại<input type="text" name="tenloai"><br>Thêm Loại<input type="submit" value="Thêm" name="them">
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
	postIndex('maloai'),
	postIndex('tenloai')];
	$sql="insert into loai(maloai, tenloai)
	values(?, ?)";
$stm= $obj->prepare($sql);
$stm->execute($data);
header('location:quanly_loai.php');

}
