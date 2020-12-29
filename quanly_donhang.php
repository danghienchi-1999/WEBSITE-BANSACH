<?php 
session_start();
if(isset($_SESSION["taikhoan"]))
{
	echo '<h2 style="color:red;">Chào - '. $_SESSION["taikhoan"]. '<a href="index.php">Trở về</a></h2>';
}
else
{
	header('location:login_admin.php');
}
?>
<?php
include"connect.php";
$taikhoan=$_SESSION["taikhoan"];
$sql="SELECT distinct donhang.madonhang,donhang.ngaydathang,donhang.trangthai,donhang.thanhtien FROM donhang inner join chitietdonhang on donhang.madonhang = chitietdonhang.madonhang join khachhang on donhang.taikhoankhachhang=khachhang.taikhoan where khachhang.taikhoan LIKE '%$taikhoan%' " ;
$stm=$obj->query($sql);
$data=$stm->fetchAll();




$sql="SELECT sach.tensach, chitietdonhang.soluong,chitietdonhang.dongia,donhang.madonhang FROM chitietdonhang join donhang on chitietdonhang.madonhang=donhang.madonhang join sach on chitietdonhang.masach=sach.masach   where donhang.taikhoankhachhang  LIKE '%$taikhoan%'";
$stm=$obj->query($sql);
$data1=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ ĐƠN HÀNG</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<th colspan="5">Đơn hàng</th>
<tr>
	<td>Mã đơn hàng</td>
	<td>Ngày đặt hàng</td>
	<td>Trạng thái</td>
	<td>Thành tiền</td>
	<td>Huỷ đơn hàng</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	$trangthai='Đang chờ xử lý';
	if($value['trangthai']==1)
		$trangthai=$trangthai;
	else if($value['trangthai']==2)
			$trangthai='Đã xác nhận đơn hàng';
		else if($value['trangthai']==3)
			$trangthai='Đang giao hàng';

	
			
	?>
	<tr>
		<td><?php echo $value['madonhang']?></td>
		<td><?php echo $value['ngaydathang']?></td>
		<td><?php echo $trangthai ?></td>
		<td><?php echo $value['thanhtien']?></td>
		<td><form action="quanly_donhang.php?madonhang=<?php echo $value['madonhang']?>" method="post"><input type="submit" value="HỦY ĐƠN HÀNG" name="huy"></form>
</td>
		
	</tr>
	<?php

}

?>

</table>
<hr><hr><hr>

<table>
	<th colspan="4" >Chi tiết đơn hàng</th>
<tr>
	<td>Chi tiết thuộc đơn hàng</td>
	<td>Tên sách</td>
	<td>Số lượng</td>
	<td>Đơn giá</td>
	
</tr>

<?php 
foreach($data1 as $key=>$value)
{

	?>

	<tr><td><?php echo $value['madonhang']?></td>
		<td><?php echo $value['tensach']?></td>
		<td><?php echo $value['soluong']?></td>
			<td>
	<?php echo $value['dongia']?>
		</td>
	
		
	</tr>

	<?php
}
?>
</table>
</div>
<?php 

if(isset($_POST["huy"]))
{

	$ngayhuy=date("Y/m/d");
	$ma=$_GET['madonhang'];
	$sql="SELECT * FROM donhang where madonhang='$ma'";
	$stm=$obj->query($sql);
	$data2= $stm->fetch();
	$trangthai = $data2['trangthai'];
	$ngaydathang=$data2['ngaydathang'];
	if($trangthai==1)
	{
		$sql ="DELETE FROM donhang where madonhang='$ma'";
     	$stm = $obj->prepare($sql);
  		$stm->execute();

	}
	else if($trangthai==2)
	{
		$ngay2 = strtotime($ngayhuy);
		$ngay1= strtotime($ngaydathang);
		$datediff = abs($ngay2- $ngay1);
		$ketqua = floor($datediff / (60*60*24));

		if($ketqua >=0 && $ketqua <=1)
	{	$sql ="DELETE FROM donhang where madonhang='$ma'";
     	$stm = $obj->prepare($sql);
  		$stm->execute();
  	}
  	else
  	{
  		echo'<h2> Thời gian đơn hàng xác nhận đã vượt quá 1 ngày, không thể huỷ đơn hàng</h2>';
  	}

	}
	header('location:quanly_donhang.php');
}

?>
</body>