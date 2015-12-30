<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolio Item - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/portfolio-item.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <?php
        // 判斷現在在哪一頁
        if (isset($_GET['page'])) {
            $current = $_GET['page'];
        } else {
            $current = 1;   // 未設定,顯示第一頁
        }
        if(isset($_GET['mv'])) {
            $mv= $_GET['mv'];
        } else {
            $mv=0;
        }
        // put your code here
        require_once 'db.php';
        // 第一次查詢, 得知總筆數
        $sql = "SELECT * FROM video ORDER BY mid";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result); // 總筆數
        // 設定每一分頁顯示多少筆
        $per = 4;
        $pages = ceil($total / $per);

        // 查詢並顯示該分頁內容
        //echo '現在在第' . $current . '頁<br>';
        $start = ($current - 1) * $per;
        $query = $sql . ' LIMIT ' . $start . ',' . $per;
        $result = mysql_query($query);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            //echo $row['title'] . '<BR>';
            array_push($videos, $row);
        }
        $headline = $videos[$mv];
        ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">影音網站</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">關於本站</a>
                        </li>
                        <li>
                            <a href="#">服務</a>
                        </li>
                        <li>
                            <a href="#">聯絡我們</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <!-- Portfolio Item Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small><?=$headline['title']?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Portfolio Item Row -->
            <div class="row">

                <div class="col-md-8">
                    <?php
                    $videoid = $headline['videoid'];
                    ?>
                    <iframe width="750" height="500"
                            src="http://www.youtube.com/embed/<?=$videoid?>?autoplay=1">
                    </iframe>
                </div>

                <div class="col-md-4">                    
                    <p>
                        <?php
                        $length = mb_strlen($headline['description']);
                        if($length >= 300) {
                            $str = mb_substr($headline['description'],0,300,'UTF-8');
                        } else {
                            $str = $headline['description'];
                        }
                        ?>
                            <?=$str?>
                    </p>
                    <h3>Project Details</h3>
                    <ul>
                        <li>Lorem Ipsum</li>
                        <li>Dolor Sit Amet</li>
                        <li>Consectetur</li>
                        <li>Adipiscing Elit</li>
                    </ul>
                </div>

            </div>
            <!-- /.row -->

            <!-- Related Projects Row -->
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header">其他影片</h3>
                </div>
<?php
for($i=0 ; $i<count($videos); $i++) {
?>
                <div class="col-sm-3 col-xs-6">
                    <a href="index.php?page=<?=$current?>&mv=<?=$i?>">
                        <img class="img-responsive portfolio-item" src="<?=$videos[$i]['thumbnail']?>" alt="">
                    </a>
                </div>
<?php
}
?>

            </div>
            <!-- /.row -->
            <div>
                <?php
                // 顯示分頁超連結
                for ($i = 1; $i <= $pages; $i++) {
                    echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
                }
                ?>
            </div>
            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
