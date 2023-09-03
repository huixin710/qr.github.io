<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>QR Fun!好集好禮好有趣!</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/tooplate-gotto-job.css" rel="stylesheet">
    <link href="css/nav.css" rel="stylesheet">


    <?php
    include("includes/connection.php");
    session_start();
    $id = $_SESSION['id'];
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $today = date('Y-m-d H:i:s'); // 目前的日期
    ?>
 
 <style>
        :root {
            --white-color: #ffffff;
            --primary-color: #f1c16d;
            --secondary-color: #f0670d;
            --section-bg-color: #f0f8ff;
            --custom-btn-bg-color: #FFA600;
            --social-icon-link-bg-color: #e7994f;
            --search-activity-bg-color: #FFF3DE;
        }
    </style>

</head>

<body id="top">
    <?php
    require("includes/app_nav.php");
    ?>
    <main>

        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <header class="w3-panel w3-center w3-opacity" style="padding:64px 16px text-center">
                        <h1 class="w3-xlarge">活動紀錄</h1>

                        <div class="w3-padding-32   text-center">
                            <p>以下是所有的活動</p>
                        </div>

                        <div class="w3-padding-32">
                            <div class="w3-bar w3-border text-center">
                                <a href="history_test.php" class="w3-bar-item w3-button  w3-light-grey">全部</a>
                                <a href="history_nostart.php" class="w3-bar-item w3-button">未開始</a>
                                <a href="history_start.php" class="w3-bar-item w3-button">正在進行</a>
                                <a href="history_end.php" class="w3-bar-item w3-button w3-hide-small">已結束</a>
                            </div>
                        </div>

                    </header>


                    <?php
                    $result = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` WHERE `appid`='$id' ORDER BY `builddatetime`desc");
                    $data_nums = mysqli_num_rows($result); //統計總比數
                    $per = 10; //限制幾筆                                                                                                
                    $pages = ceil($data_nums / $per); //取得不小於值的下一個整數
                    if (!isset($_GET["page"])) { //假如 $_GET["page"] 未設置
                        $page = 1; //則在此設定起始頁數
                    } else {
                        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
                    }
                    $start = ($page - 1) * $per; //計算起始值


                    ?>

                    <div class="col-lg-12 col-12">
                        <?php

                        //root系統管理員
                        if ($id == 'root') {
                            $result1 = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` ORDER BY `builddatetime`desc LIMIT $start,$per");
                        } else {
                            $result1 = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` WHERE `appid`='$id' ORDER BY `builddatetime`desc LIMIT $start,$per");
                        }
                        while ($row = mysqli_fetch_array($result1)) {
                            $status = '';

                            if ($today < $row[3]) {
                                $status = '尚未開始';
                                $disableModifyButton  = false;
                            } elseif ($today > $row[4]) {
                                $status = '已結束';
                                $disableModifyButton  = true;
                            } else {
                                $status = '進行中';
                                $disableModifyButton  = false;
                            }

                        ?>
                        <a href='detailed.php?aid=<?php echo $row[0] ?>' class='job-title-link'>
                            <div class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="images/site-header/logo2.png" class="img-fluid" alt="">
                                </div>

                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0">
                                            <?php
                                            echo "$row[1]";
                                            ?>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center">
                                            <?php
                                            echo "<p class='job-location mb-0'>
                                                <i class='custom-icon bi-geo-alt me-1'></i>
                                                $row[2]
                                            </p>";
                                            echo "<p class='job-date mb-0'>
                                                <i class='custom-icon bi-clock me-1'></i>
                                                結束時間：$row[4]
                                            </p>";
                                            ?>
                                        </div>
                                    </div>

                                    <div class="job-section-btn-wrap">
                                        <table>
                                            <tr>
                                        <?php
                                            echo "<td><a href='analyze.php?aid=$row[0]' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='活動狀況' style='background-color: transparent;  border:none; color:white;' ></a></td>";  
                                            echo "<td><a href='delete.php?aid=$row[0]' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='刪除活動' style='background-color: transparent;  border:none; color:white;' ></a></td>";
                                        ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php } ?>
                        <?php
                        //頁碼
                        $page1 = $page - 1;
                        $page2 = $page + 1;
                        //分頁頁碼                   
                        ?>
                        <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                            <?php
                            echo '<div class=badge style="text-align:center;" >共 ' . $data_nums . ' 筆-第 ' . $page . ' 頁-共 ' . $pages . ' 頁</div><br>';
                            ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-5">
                                    <li class="page-item">
                                        <a class="page-link" href="history_test.php?page=1" aria-label="Previous">
                                            <span aria-hidden="true">首頁</span>
                                        </a>
                                    </li>
                                    <?php if ($page != 1) { ?>

                                        <li class="page-item">
                                            <?php echo ' <a class="page-link" href="history_test.php?page=' . $page1 . ' ">'; ?>
                                            <span aria-hidden="true">
                                                << /span>
                                                    </a>
                                        </li>
                                        <?php
                                    }
                                    for ($i = 1; $i <= $pages; $i++) {
                                        if ($page - 3 < $i && $i < $page + 3) {
                                            if ($page == $i) {
                                        ?>

                                                <li class="page-item active" aria-current="page">
                                                <?php //後面頁碼網址
                                                echo '<a class="page-link" href="history_test.php?page=' . $i . '">' . $i . '</a></li>';
                                            }
                                            if ($page != $i) { ?>

                                                <li class="page-item " aria-current="page">
                                        <?php //後面頁碼網址
                                                echo '<a class="page-link" href="history_test.php?page=' . $i . '">' . $i . '</a></li>';
                                            }
                                        }
                                    } ?>

                                        <?php if ($page != $pages) { ?>

                                                <li class="page-item">
                                                    <?php echo ' <a class="page-link" href="history_test.php?page=' . $page2 . ' ">'; ?>
                                                    <span aria-hidden="true">></span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li class="page-item">
                                                <?php echo ' <a class="page-link" href="history_test.php?page=' . $pages . ' ">'; ?>
                                                <span aria-hidden="true">末頁</span>
                                                </a>
                                            </li>
                                </ul>
                                <br>

                            </nav>
                            <!-- 頁碼尾 -->

                        </div>

                    </div>
                </div>
        </section>
    </main>

    <footer class="site-footer ">
        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center">
                        <p class="copyright-text">QR Fun!好集好禮好有趣!</p>
                    </div>
                    <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>