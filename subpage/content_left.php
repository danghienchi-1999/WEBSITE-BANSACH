<div class="templatemo_content_left_section">
    <h1>Danh Sách Các Quyển Sách Mới</h1>
    <ul>
        <?php
        $tam = $obj->query('select * from sach order by rand() limit 7');
        $data = $tam->fetchAll();
        foreach ($data as $key => $value)
        {
        ?>
        <li><a href="sach_moi.php?masach=<?php echo $value['masach'] ?>"><?php echo $value['tensach'] ?></a></li>
        <?php
        }
        ?>
    </ul>
</div>
<div class="templatemo_content_left_section">
    <h1>Danh Sách Các Quyển Sách Bán Chạy</h1>
    <ul>
        <?php 
        $tam = $obj->query('select * from sach order by luotmua desc limit 5');
        $data = $tam->fetchAll();
        foreach ($data as $key => $value) {
        ?>
        <li><a href="chitiet.php?masach=<?php echo $value['masach'] ?>"><?php echo $value['tensach'] ?></a></li>
        <?php
        }?>
    </ul>
</div>

