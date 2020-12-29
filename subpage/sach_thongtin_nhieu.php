<?php
//$soluong =$_GET['count'];
$maloai = $_GET['masach'];
$tam = $obj->query("select * from sach  where tensach LIKE '%$maloai%' ");
$data = $tam->fetchAll();
//echo 'Tìm thấy'.' '. $soluong.' '.'kết quả';
foreach ($data as $key => $value)
{
?>
<div class="templatemo_product_box">
    <h1><?php echo $value ['tensach'] ?></h1>
    <img src="images/<?php echo $value['hinh']?>" alt="image" width="100" height="100"/>
    <div class="product_info">
        <h3>
        <?php echo number_format($value['gia']) ?> VNĐ
        </h3>
        <div class="buy_now_button"><a href="quanly_giohang.php?action=them&masach=<?php echo $value['masach']?>">Đặt Sách</a></div>
        <div class="detail_button"><a href="chitiet.php?masach=<?php echo $value['masach']?>">Chi Tiết</a></div>
    </div>
    <div class="cleaner">&nbsp;</div>
</div>
<?php
}

?>