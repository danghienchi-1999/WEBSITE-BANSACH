<?php include 'connect.php';
session_start();
 if(isset($_POST["dangnhap"]))
 {
 	if(empty($_POST["taikhoan"]) || empty($_POST["matkhau"]))
 	{
 		echo '<h1>Điền đầy đủ các trường</h1>';
 	}
 	else
 	{	
 		$sql="SELECT * FROM admin WHERE taikhoan= :taikhoan AND matkhau= :matkhau AND quyen=1";
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
 			$_SESSION["admin"]=1;
 			header('location:quanly_admin1.php');
  		}else 
  		{
  			$sql="SELECT * FROM admin WHERE taikhoan= :taikhoan AND matkhau= :matkhau AND quyen=2";
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
 			$_SESSION["admin"]=2;
 			header('location:quanly_admin2.php');
  		}
  		}
  			echo'<h1>Sai tên đăng nhập hoặc mật khẩu</h1>';
  	 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đăng Nhập ADMIN</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#333333">
	
	<div id="templatemo_login">
		<h1>Đăng nhập</h1><br>
		<form action="" method="post">
			Tài Khoản <input type="text" name="taikhoan"><br><br><br>
			Mật Khẩu <input type="password" name="matkhau"><br><br><br>
			<input type="submit" name="dangnhap" value="Đăng Nhập">
				
		
</form>
	</div>


</body>
</html>