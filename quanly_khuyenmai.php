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
$sql="SELECT * FROM khuyenmai ";
$stm=$obj->query($sql);
$data=$stm->fetchAll();
$sql="SELECT * FROM sach  ";
$stm=$obj->query($sql);
$data1=$stm->fetchAll();
$sql="SELECT * FROM loai  ";
$stm=$obj->query($sql);
$data2=$stm->fetchAll();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QUẢN LÝ Khuyến mãi</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="templatemo_container">
<table border="1">
<tr>
	<td>Mã khuyến mãi</td>
	<td>Tên khuyến mãi</td>
<td>Thao tác</td>
	<td>Thao tác</td>
</tr>

<?php 
foreach($data as $key=>$value)
{
	?>
	<tr>
		<td><?php echo $value['makhuyenmai']?></td>
		<td><?php echo $value['tenkhuyenmai']?></td>
		
			<td>
			<a href="xoa.php?makhuyenmai=<?php echo $value['makhuyenmai'] ?>">Xoá Khuyến mãi</a>

		</td>
		<td><a href="capnhat.php?action=suakhuyenmai&makhuyenmai=<?php echo $value['makhuyenmai'] ?>">Cập nhật Khuyến mãi</a></td>
		
	</tr>
	<?php
}
?>

<form method="post" enctype="multipart/form-data" >Tên Khuyến mãi<input type="text" name="tenkhuyenmai"><br>Tác động đến sách<select name="sach">	
	<option value="null">NULL</option>	
		<option value="all">ALL</option>		
					<?php 
					foreach ($data1 as $key => $value1) {
						?>
						
						<option value="<?php echo $value1['masach'] ?>">
							<?php echo $value1['tensach'] ?>
						</option>
						<?php
					}
					?>
				</select><br>
		Tác động đến loại sách<select name="loai">	
			<option value="null">NULL</option>	
			
					<?php 
					foreach ($data2 as $key => $value2) {
						?>
						
						<option value="<?php echo $value2['maloai'] ?>">
							<?php echo $value2['tenloai'] ?>
						</option>
						<?php
					}
					?>
				</select><br>Giảm <input type="text" name="giam">%<br>Tăng <input type="text" name="tang">%<br>Thêm Khuyến mãi<input type="submit" value="Thêm" name="them"><br>
</form>


</table>
</div>
</body>
<?php 
if (isset($_POST['them'])){

function postIndex($i, $v='')
{
	return isset($_POST[$i])?$_POST[$i]:$v;
}

$taikhoanadmin=$_SESSION['taikhoan'];
$data =[
	postIndex('tenkhuyenmai'),
	$taikhoanadmin
];
	$sql="insert into khuyenmai(tenkhuyenmai,taikhoanadmin)
	values(?, ?)";
$stm= $obj->prepare($sql);
$stm->execute($data);
if(isset($_POST['sach']))
	{	$giatien=0;
			$sach=$_POST['sach'];
		if(isset($_POST['giam']))
			{
				$giatien=ceil($_POST['giam']);
							if($sach=='all')	
				{ 	
					$sql="UPDATE SACH SET GIA = GIA-((GIA*'$giatien')/100)";	
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
				else if($sach!='null')
				{	
					$sql="UPDATE SACH SET GIA = GIA-((GIA*'$giatien')/100) WHERE masach='$sach'";
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
			}
		if(isset($_POST['tang']))
			{
				$giatien=ceil($_POST['tang']);
				if($sach=='all')	
				{ 	
					$sql="UPDATE SACH SET GIA = GIA+((GIA*'$giatien')/100)";	
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
				else if($sach!='null')
				{	
					$sql="UPDATE SACH SET GIA = GIA+((GIA*'$giatien')/100) WHERE masach='$sach'";
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
			}	
	}
	if(isset($_POST['loai']))
	{	$giatien=0;
		$loai=$_POST['loai'];
		if(isset($_POST['giam']))
			{
				$giatien=ceil($_POST['giam']);
				 if($loai!='null')
				{	
					$sql="UPDATE SACH SET GIA = GIA-((GIA*'$giatien')/100) WHERE maloai='$loai'";
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
			}
		if(isset($_POST['tang']))
			{
				$giatien=ceil($_POST['tang']);
				 if($loai!='null')
				{	
					$sql="UPDATE SACH SET GIA = GIA+((GIA*'$giatien')/100) WHERE maloai ='$loai'";
					$stm = $obj->prepare($sql);
					$stm->execute();
				}
			}	
	}
header('location:quanly_khuyenmai.php');	
}





