<?php include 'connect.php';
if(!isset($_SESSION))
session_start();
 if(isset($_POST["dangnhap"]))
 {
 	if(empty($_POST["taikhoan"]) || empty($_POST["matkhau"]))
 	{
 		echo '<h1>Điền đầy đủ các trường</h1>';
 	}
 	else
 	{	
 		$sql="SELECT * FROM khachhang WHERE taikhoan= :taikhoan AND matkhau= :matkhau";
 		$stm=$obj->prepare($sql);
 		$stm->execute(
 			array(  
 				'taikhoan' => $_POST["taikhoan"],
 				'matkhau' => $_POST["matkhau"]
 			)
 		);
 		$count = $stm->rowCount(); 
 		if($count>0)
 		{ 	
 			$_SESSION["taikhoan"]=$_POST["taikhoan"];
 			
 			header('location:index.php');
  		}
  		else 		
  			echo'<h1>Sai tên đăng nhập hoặc mật khẩu</h1>';
  	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Đăng Nhập Khách Hàng</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body >
	<div id="templatemo_container">
<div id="templatemo_menu"><?php include'subpage/menu.php' ?></div> <!-- end of menu -->
<div id="templatemo_header"><?php include 'subpage/header.php' ?></div> <!-- end of header -->
<div id="templatemo_content">
<div id="templatemo_content_left"><?php include'subpage/content_left.php' ?></div>
<div id="templatemo_content_left">
		<h1>Đăng nhập</h1><br>
		<form action="" method="get">
			Tài Khoản <input type="text" name="taikhoan"><br><br><br>
			Mật Khẩu <input type="password" name="matkhau"><br><br><br>
			<input type="submit" name="dangnhap" value="Đăng Nhập">
				
			
</form>
	</div>
	</div>
</div>

</body>
</html>