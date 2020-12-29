<?php
if(!isset($_SESSION)){session_start();}
$masach = $_GET['masach'];
$tam = $obj->query("select * from sach where masach = '$masach' ");
$data = $tam->fetchAll();

$sql="SELECT * FROM binhluan where masacch ='$masach'";
$stm=$obj->query($sql);
$data1=$stm->fetchAll();
foreach ($data as $key => $value)
{
?>
<div class="templatemo_product_newbook">
    <h1><?php echo $value ['tensach'] ?></h1>
    <img src="images/<?php echo $value['hinh']?>" alt="image" />
    <div class="product_info">
        <p><?php echo $value['mota']?></p>
        <h3>
        <?php echo number_format($value['gia']) ?> VNĐ
        </h3>
       <div class="buy_now_button"><a href="quanly_giohang.php?action=them&masach=<?php echo $value['masach']?>">Đặt Sách</a></div>
        <table border="1"><?php foreach ($data1 as $key => $value) { 
            ?>
           <tr><td><?php echo 'Khác hàng : '.$value['taikhoankhachhang'].'<br>Bình luận'.' : '.$value['noidung']  ?></td> </tr> 
        <?php } 
        ?></table>
    </div>
    <form method="post">Bình luận <input type="textarea" size="70" name="binhluan"><input type="submit" name="gui">
    </form>
    <div class="cleaner">
</div>
</div>
<?php
}
if(isset($_POST['gui']) && isset($_SESSION['taikhoan']))
{
    $taikhoan=$_SESSION['taikhoan'];
    $sql="SELECT taikhoan FROM khachhang JOIN donhang on khachhang.taikhoan=donhang.taikhoankhachhang";
    $stm=$obj->query($sql);
    $data=$stm->fetchall(); 
    foreach ($data as $key => $value) {
    if($taikhoan == $value["taikhoan"])
    {
        $binhluan=$_POST["binhluan"];
        $data1 =[$taikhoan,$masach,$binhluan];
        $sql="insert into binhluan(taikhoankhachhang, masacch, noidung) values(?, ?, ?)";
        $stm= $obj->prepare($sql);
        $stm->execute($data1);
    }
}

}



    