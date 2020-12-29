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
$sql="SELECT * FROM banner ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
$sql="SELECT * FROM tintuc ";
$stm=$obj->query($sql);
$data1=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ Banner</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
	<td>Mã Banner</td>
	<td>Hình</td>
	<td>Chứa tin tức</td>
	<td>Thao tác</td>
	<td>Thao tác</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	$ten=$value['matintuc'];
	$sql="SELECT tentintuc from tintuc where matintuc = '$ten'";
	$stm = $obj->prepare($sql);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
	?>
	<tr>
		<td><?php echo $value['mabanner']?></td>
		<td><img src="images/<?php echo $value['hinh']?>" alt="image" width="100" height="100"/></td>
		<td><?php echo $row['tentintuc']?></td>
			<td>
			<a href="xoa.php?mabanner=<?php echo $value['mabanner'] ?>">Xoá Banner</a>

		</td><td>
			<a href="capnhat.php?mabanner=<?php echo $value['mabanner'] ?>">Cập nhật Banner</a>

		</td>
		
	</tr>
	<?php
}
?>
<form method="post" enctype="multipart/form-data" >Mã Banner <input type="text" name="mabanner"><br>Hình<input type="file" name="hinh"><br>Thuộc tin tức<select name="matintuc">			
					<?php 
					foreach ($data1 as $key => $value) {
						?>
						
						<option value="<?php echo $value['matintuc'] ?>">
							<?php echo $value['tentintuc'] ?>
						</option>
						<?php
					}
					?>
				</select><br>Thêm Banner<input type="submit" value="Thêm" name="them">
</table>
</div>
</body>
<?php 
if (isset($_POST['them']))
{
$hinh = $_FILES['hinh']['error']==0?$_FILES['hinh']['name']:'';
	function postIndex($i, $v='')
	{
	return isset($_POST[$i])?$_POST[$i]:$v;
	}
	$taikhoanadmin=$_SESSION['taikhoan'];
	$data =[
	postIndex('mabanner'),
	$hinh,
	postIndex('matintuc'),
	$taikhoanadmin];
	$sql="insert into banner(mabanner, hinh, matintuc, taikhoanadmin)
	values(?, ?, ?, ?)";
	$stm= $obj->prepare($sql);
	$stm->execute($data);
	if ($hinh !='')
	{move_uploaded_file($_FILES['hinh']['tmp_name'], "../templatemo_086_book_store/images/$hinh");}

	header('location:quanly_banner.php');}


