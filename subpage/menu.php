<?php 
if(!isset($_SESSION))
session_start();
if(isset($_SESSION["taikhoan"]) && !isset($_SESSION["admin"]))
{
    $ten = $_SESSION['taikhoan'];
	echo'<ul> 
           <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="logout_khachhang.php">Đăng xuất</a></li>
            <li><a href="about.php">Về Chúng tôi</a></li> 
            <li><a href="quanly_donhang.php">Quản lý đơn hàng</a></li>
            <li><form method="post"><input type="text" name="txttimkiem" placeholder="Tìm kiếm"><input type="submit" name="btntimkiem" value="Tìm Kiếm"></form></li>
        </ul>';
    echo' chào ' .$ten;
   
}
else
{
    echo'<ul> 
           <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="login_khachhang.php">Đăng nhập</a></li>
            <li><a href="about.php">Về Chúng tôi</a></li> 
            <li><a href="dangky.php">Đăng Ký</a></li>
      <li><form method="post"><input type="text" name="txttimkiem" placeholder="Tìm kiếm"><input type="submit" name="btntimkiem" value="Tìm Kiếm"></form></li>
        </ul>';   
	session_destroy();
}

if (isset($_POST['btntimkiem'])) 
{  $datatk = addslashes($_POST['txttimkiem']);
    
       $query = "SELECT maloai FROM loai WHERE tenloai LIKE '%$datatk%' ";
        $stm = $obj->prepare($query);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $count = $stm->rowCount(); 
        if($count>0)    
        {
                   header('location:chitiet_loai.php?maloai='.$row['maloai']);
        }
        else
        {
        $query = "SELECT masach FROM sach WHERE tensach LIKE '%$datatk%' ";
        $stm = $obj->prepare($query);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $count = $stm->rowCount();   
        if($count>1)
        {     
              header('location:chitiet_nhieu.php?masach='.$datatk.'&count='.$count);
        } 
        else if($count>0)    
        {
              header('location:chitiet.php?masach='.$row['masach']);
                  
        }
      
        }

}
?>
              