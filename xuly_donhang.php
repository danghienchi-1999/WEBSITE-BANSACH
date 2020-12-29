<?php 
session_start();
if(isset($_SESSION["taikhoan"])  && $_SESSION["admin"]==2)
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

$sql="SELECT * FROM donhang" ;
$stm=$obj->query($sql);
$data=$stm->fetchAll();




$sql="SELECT sach.tensach, chitietdonhang.soluong,chitietdonhang.dongia,donhang.madonhang FROM chitietdonhang join donhang on chitietdonhang.madonhang=donhang.madonhang join sach on chitietdonhang.masach=sach.masach  ";
$stm=$obj->query($sql);
$data1=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XỬ LÝ ĐƠN HÀNG</title>
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
			else if($value['trangthai']==4)
			$trangthai='Đã thanh toán';

			
	
			
		
	?>
	<tr>
		<td><?php echo $value['madonhang']?></td>
		<td><?php echo $value['ngaydathang']?></td>
		<td><?php echo $trangthai ?><a href="xuly_donhang.php?action=xacnhan&madonhang=<?php echo $value['madonhang'] ?>">-Xác nhận</a></td>
		<td><?php echo $value['thanhtien']?></td>
		<td><form action="xuly_donhang.php?madonhang=<?php echo $value['madonhang']?>" method="post"><input type="submit" value="HỦY ĐƠN HÀNG" name="huy"></form>
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
{		$ma=$_GET['madonhang'];
		$sql ="DELETE FROM donhang where madonhang='$ma'";
     	$stm = $obj->prepare($sql);
		  $stm->execute();
		  header('location:xuly_donhang.php');
}
$action= isset($_GET['action'])?$_GET['action']:'';
if($action=='xacnhan')
{
		$madonhang= isset($_GET['madonhang'])?$_GET['madonhang']:'';
		$sql="SELECT trangthai FROM donhang WHERE madonhang='$madonhang'";
		$stm = $obj->prepare($sql);
		$data=$stm->execute();
	
		if($data==1)
	{	
		$sql="UPDATE donhang SET trangthai=2 WHERE madonhang='$madonhang'";
    	$stm = $obj->prepare($sql);
		  $stm->execute();
		  exit;
	}
			if($data==2)
			{
			$sql="UPDATE donhang SET trangthai=3 WHERE madonhang='$madonhang'";
   		 $stm = $obj->prepare($sql);
		  $stm->execute();
		  exit;
			}
			if($data==3)
			{
				$sql="UPDATE donhang SET trangthai=4 WHERE madonhang='$madonhang'";
    $stm = $obj->prepare($sql);
		  $stm->execute();
		  exit;
			}
			header('location:xuly_donhang.php');
}
?>
</body>