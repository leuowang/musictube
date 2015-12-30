<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // 判斷現在在哪一頁
        if(isset($_GET['page'])) {
            $current = $_GET['page'];
        } else {
            $current = 1;   // 未設定,顯示第一頁
        }
        // put your code here
        require_once 'db.php';
        // 第一次查詢, 得知總筆數
        $sql = "SELECT * FROM video ORDER BY mid";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result); // 總筆數
        // 設定每一分頁顯示多少筆
        $per = 4;
        $pages = ceil($total / $per) ;
        
        // 查詢並顯示該分頁內容
        echo '現在在第'. $current . '頁<br>';
        $start = ($current-1)*$per ;
        $query = $sql .' LIMIT '.$start.','.$per;
        $result = mysql_query($query);
        while( $row = mysql_fetch_assoc($result)) {
            echo $row['title'].'<BR>';
        }
        // 顯示分頁超連結
        for($i = 1; $i<= $pages; $i++) {
            echo '<a href="index.php?page='.$i.'">'. $i.'</a> ';
        }
        ?>
    </body>
</html>
