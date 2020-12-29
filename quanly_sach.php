<?php 
session_start();
if(isset($_SESSION["taikhoan"]) && $_SESSION["admin"]==1)
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
$sql="SELECT * FROM sach ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
$stm = $obj->query('select * from loai');
$data1 = $stm->fetchAll();
$stm = $obj->query('select * from tacgia');
$data2 = $stm->fetchAll();
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
<div id="templatemo_container">

<table border="1" >
<tr>
	<td>Hình</td>
	<td>Mã sách</td>
	<td>Tên sách</td>
	<td>Thuộc thể loại</td>
	<td>Đơn giá</td>
	<td>Xoá Sách</td>
	<td>Cập nhật sách</td>

</tr>

<?php 
foreach($data as $key=>$value)
{   $ten=$value['maloai'];
	$sql="SELECT tenloai from loai where maloai = '$ten'";
	$stm = $obj->prepare($sql);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
	?>
	<tr>
		<td><img src="images/<?php echo $value['hinh']?>" alt="image" width="100" height="100"/></td>
		<td><?php echo $value['masach']?></td>
		<td><?php echo $value['tensach']?></td>
		<td><?php echo $row['tenloai']?></td>
		<td><?php echo $value['gia']?></td>
		<td><a href="xoa.php?masach=<?php echo $value['masach'] ?>">
			Xoá Sách</a></td><td><a href="capnhat.php?masach=<?php echo $value['masach'] ?>">
			Cập nhật Sách</a></td>

	</tr>

	<?php
}
?>
<form method="post" enctype="multipart/form-data" >Mã sách <input type="text" name="masach"><br>Tên sách<input type="text" name="tensach"><br>Mô tả <input type="textarea" name="mota"><br>Giá<input type="text" name="gia"> <br>Hình <input type="file" name="hinh" title=" "> <br>Thể loại<select name="maloai">			
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
				<br>Số lượng <input type="text" name="soluong">
				<br>Thêm sách<input type="submit" value="Thêm" name="them"></form>
</table>

</div>

</body>
<?php 
if (isset($_POST['them'])) {
$hinh = $_FILES['hinh']['error']==0?$_FILES['hinh']['name']:'';
function postIndex($i, $v='')
{
	return isset($_POST[$i])?$_POST[$i]:$v;
}
$luotmua=0;
$data =[
	postIndex('masach'),
	postIndex('tensach'),
	postIndex('mota'),
	postIndex('gia'),
	$hinh,
	postIndex('maloai'),
	postIndex('matacgia'),
	$luotmua,
	postIndex('soluong')
];

$sql="insert into sach(masach, tensach, mota, gia, hinh, maloai, matacgia, luotmua,soluong)
	values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stm= $obj->prepare($sql);
$stm->execute($data);
if ($hinh !='')
	{move_uploaded_file($_FILES['hinh']['tmp_name'], "../templatemo_086_book_store/images/$hinh");}
echo"<script type='text/javascript' >window.location='quanly_sach.php'</script>";
}

?>

