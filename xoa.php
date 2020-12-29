<?php 
include'connect.php';
$masach = isset($_GET['masach'])?($_GET['masach']):'';
$taikhoankhachhang = isset($_GET['taikhoankhachhang'])?($_GET['taikhoankhachhang']):'';
$maloai =isset($_GET['maloai'])?($_GET['maloai']):'';
$matacgia= isset($_GET['matacgia'])?($_GET['matacgia']):'';
$makhuyenmai=isset($_GET['makhuyenmai'])?($_GET['makhuyenmai']):'';
$mabanner=isset($_GET['mabanner'])?($_GET['mabanner']):'';
$matintuc=isset($_GET['matintuc'])?($_GET['matintuc']):'';
if($masach != '')
{
	$sql="DELETE FROM sach WHERE masach='$masach'";
	$stm = $obj->prepare($sql);
		$stm->execute();
		header('location:quanly_sach.php');	
}
else if($maloai != '')
{
	$sql="DELETE FROM loai WHERE maloai='$maloai'";
	$stm = $obj->prepare($sql);
		$stm->execute();
		header('location:quanly_loai.php');	
}
else if($matacgia != '')
{
	$sql="DELETE FROM tacgia WHERE matacgia='$matacgia'";
		$stm = $obj->prepare($sql);
		$stm->execute();
header('location:quanly_tacgia.php');	
}
else if($taikhoankhachhang != '')
{
	$sql="DELETE FROM khachhang WHERE taikhoan='$taikhoankhachhang'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_khachhang.php');	
}
else if($makhuyenmai !='')
{
	$sql="DELETE FROM khuyenmai WHERE makhuyenmai='$makhuyenmai'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_khuyenmai.php');	
}
else if($matintuc !='')
{
	$sql="DELETE FROM tintuc WHERE matintuc='$matintuc'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_tintuc.php');	
}
else if($mabanner !='')
{
	$sql="DELETE FROM banner WHERE mabanner='$mabanner'";
	$stm = $obj->prepare($sql);
$stm->execute();
header('location:quanly_banner.php');	
}


