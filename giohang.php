<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIỎ HÀNG</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<?php
include'connect.php';
if (!isset($_SESSION)) session_start();
$tam= isset($_SESSION['cart'])?$_SESSION['cart']:[];
?>
<a href="index.php"><h2>Tiếp tục mua (Quay lại)</h2></a>  
<a href="quanly_giohang.php?action=huy"> <h2>Huỷ giỏ hàng </h2></a>
<hr>
<body>
<table border="1" class="abc" id="abc">
	<tr>
		<td>STT</td>
		<td>Hình</td>
		<td>Tên sách</td>
		<td>Giá</td>
		<td>Số lượng</td>
		<td>Thành tiền</td>
		<td>Thao tác</td>
		<td>Thao tác</td>
		<td>Thao tác</td>

	</tr>
<?php
	$i=0;
foreach ($tam as $key => $value) 
{
	$sql= "select * from sach where masach='{$key}'";
	$stm = $obj->query($sql);
	$data = $stm->fetch();
	$i++;

	?>
	<tr>
		<td><?php echo $i ?></td>
		<td> <img src="images/<?php echo $data['hinh']?>" alt="image" width="100" height="100"/></td>
		
		<td><?php echo $data['tensach'] ?></td>
		<td><?php echo  $data['gia'] ?></td>
		<td><?php echo $value ?></td>
		<td><?php echo $value *$data['gia'] ?></td>
		<td>
			<a href="quanly_giohang.php?action=xoa&masach=<?php echo $key ?>">Xóa</a>
		</td>
		<td>
			<a href="quanly_giohang.php?action=giam&masach=<?php echo $key ?>">Giảm</a>
		</td>
		<td>
			<a href="quanly_giohang.php?action=themnua&masach=<?php echo $key ?>">Tăng</a>
		</td>
	</tr>
	<?php
}
	?>
	
</table>
<hr>
<form action="" method="post"><input type="submit" value="ĐẶT HÀNG" name="dathang"></form>

<?php 
if(isset($_POST["dathang"]))
{
  
  
 $ngaydat = date("Y/m/d");
  $taikhoan= $_SESSION['taikhoan'];
  $trangthai=1;
  $thanhtien=0;
  foreach($tam as $key => $value)
  {  $sql= "select * from sach where masach='{$key}'";
	$stm = $obj->query($sql);
	$data = $stm->fetch();
  	$thanhtien=$thanhtien+ ($value *$data['gia']);
  }
  if(!$tam==[])
   {   $sql ="insert into donhang( taikhoankhachhang,ngaydathang, trangthai, thanhtien) 
  values(?, ?,?, ?)";
  $a=[$taikhoan,$ngaydat,$trangthai,$thanhtien];
  $stm = $obj->prepare($sql);
  $stm->execute($a);

  $sql="select madonhang from donhang order by madonhang desc limit 1";
  $stm= $obj->query($sql);
  $data=$stm->fetch();
  $id=$data['madonhang'];
  	$i=0;
foreach ($tam as $key => $value) 
{
	$sql= "select * from sach where masach='{$key}'";
	$stm = $obj->query($sql);
	$data = $stm->fetch();
	$i++;
	 $sql ="insert into chitietdonhang( madonhang,masach, soluong, dongia) 
  values(?, ?,?, ?)";
    $a=[$id, $data['masach'], $value,$value*$data['gia']];
     $stm = $obj->prepare($sql);
  $stm->execute($a);


}
$mess=" Bạn đã đặt hàng thành công ";
    echo"<script type='text/javascript'>var kq=confirm('$mess');
    if(kq){window.location='quanly_giohang.php?action=huy'};</script>";
}
else{
	$mess="Giỏ hàng của bạn đang rỗng";
    echo"<script type='text/javascript'>var kq=confirm('$mess');
    if(kq){window.location='quanly_giohang.php?'};</script>";
}


}
?>
</body>
