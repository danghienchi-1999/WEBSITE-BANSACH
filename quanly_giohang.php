<?php
session_start();
if (isset($_SESSION["taikhoan"]))
{   

    $tam= isset($_SESSION['cart'])?$_SESSION['cart']:[];
    
$action= isset($_GET['action'])?$_GET['action']:'';
if ($action=='them')
{
    $masach= isset($_GET['masach'])?$_GET['masach']:'';
    $soluong = 1;
    if ($masach!='')
    {
        if (isset($tam[$masach]))
            $tam[$masach] += $soluong;
        else 
            $tam[$masach]= $soluong;
    }
}

if ($action=='xoa')
{
    $masach= isset($_GET['masach'])?$_GET['masach']:'';
    unset($tam[$masach]);
    
}
if ($action=='huy')
{
    $tam=[];
}
if($action=='giam')
{
     $masach= isset($_GET['masach'])?$_GET['masach']:'';
     if ($masach!='')
    {
        if (isset($tam[$masach]))
            $tam[$masach] -= 1;
        else 
            $tam[$masach]-= 0;
        if($tam[$masach]==0)
             unset($tam[$masach]);
    }

}
if($action=='themnua')
{
    $masach= isset($_GET['masach'])?$_GET['masach']:'';
     if ($masach!='')
    {
        if (isset($tam[$masach]))
            $tam[$masach] += 1;
        else 
            $tam[$masach]= 0;
     
    }
}

$_SESSION['cart']= $tam;
header('location:giohang.php');
}

else
{
    $mess=" Bạn phải đăng nhập mới có thể đặt mua sách ";
    echo"<script type='text/javascript'>var kq=confirm('$mess');
    if(kq){window.location='index.php'};</script>";
}
