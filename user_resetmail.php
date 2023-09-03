<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

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

    <link href="css/to.css" rel="stylesheet">

    <link href="https://fontawesome.com/icons" rel="stylesheet">




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

        .contact-info-small-title {
            color: #787878;


        }

        .contact-form .form-control:hover {
            background-color: transparent;
            border-color: #c3baa9;
        }

        .contact-form .form-control {
            background-color: transparent;
            margin-bottom: 0px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            background-color: #f0f8ff00;

            border-color: #c4333300;

            border-color: #c3baa9;
        }

        .tag_menu_con ul li a button {
            display: block;
            padding: 10px 25px;
            background: #fff;
            color: #999;
            margin: 15px;
            border-radius: 25px;
            border: 1px solid #c8c8c8;
        }
    </style>
    <?php
    include("includes/connection.php");
    session_start();
    $uid = $_SESSION['uid'];

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    ?>
</head>


<body id="top">


    <?php
    require("includes/user_nav.php");
    ?>

    <main>

        <section class="contact-section">
            <div class="container">
                <div class="row justify-content-center">
                    <h2 style="color:#787878;" class="text-center">會員資料</h2>
                    <div class="tag_menu_con">
                        <ul>
                            <li><a href="user.php" onclick="toPage_token('dataedit.html')">我的資料</a></li>
                            <li><a href="user_revise.php" onclick="toPage_token('datapw.html')">資料修改</a></li>
                            <li><a href="user_resetmail.php" onclick="toPage_token('datapw.html')" class="active">Mail驗證</a></li>
                            <li><a href="user_pw.php" onclick="toPage_token('datamb.html')">變更密碼</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-8 col-12 mx-auto" style="border:1px #696969 solid;">
                        <form class="custom-form contact-form" action="#" method="post" role="form">
                            <br>
                            <?php
                            $sql = "SELECT * FROM `user` WHERE `uid`= '$uid'";

                            $result = mysqli_query($link, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                            ?>




                                <div class='text-center'>


                                    <div class="contact-info d-flex align-items-center mb-3 text-center">
                                        <img src="images/mail.jpg" style="height:40px; width:40px;">

                                        <p class="mb-0">
                                            <span class="contact-info-small-title">&nbsp;&nbsp;&nbsp;&nbsp;新的電子郵件：
                                                <p class="mb-0 text-center">
                                                    <span style="color:#787878; font-size:20px;">
                                                        <input type="text" name="email" class="form-control" style="color:#787878; font-weight:bold; border-radius:35px; padding:15px;" value="<?php echo $row['mail']  ?>">
                                                        <!--
                                                            <div class="tag">
                                                                <ul>

                                                                    <li style="list-style-type:none;"><button type="submit" name="submail" class="form-control" onclick="toPage_token('user_revise.php')">重新驗證</button></li>

                                                                </ul>
                                                            </div>-->
                                                    </span>
                                            </span>
                                        </p>
                                    </div>
                                    <br>
                                    <div class="tag_menu_con">
                                        <ul>

                                            <li><button type="submit" name="submail" class="form-control" onclick="toPage_token('user_revise.php')">重新驗證</button></li>
                                        </ul>
                                    </div>
                                <?php
                            }

                                ?>
                                </div>
                        </form>

        </section>
    </main>

</body>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>


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

</html>
<?php

// 假設你的資料庫連接程式碼放在這裡

if (isset($_POST["submail"])) {
    $email = $_POST['email'];

    // 執行查詢，檢查此電子郵件是否已註冊


    $mail1 = stripslashes(trim($_POST['email']));
    $sql = "SELECT `uid`,`uname`,`upw`,`mail` FROM user WHERE mail = '$email'";
    $result = mysqli_query($link, $sql);

    
        // 電子郵件已註冊，發送驗證碼
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'menmenwan46@gmail.com';                     //SMTP username
            $mail->Password   = 'ahyryxxybrrqpxxw';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('roadreport01@gmail.com', 'roadreport');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            //生成驗證碼
            $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $len = strlen($str) - 1;
            $code = '';
            for ($i = 0; $i < 5; $i++) {
                $num = mt_rand(0, $len);
                $code .= $str[$num];
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "更改電子郵件";
            $mail->Body    = "請點擊以下網址進行郵件驗證：<a href='127.0.0.1/qrfun0828/user_resetmail_up.php?mail=$email&uid=$uid'>127.0.0.1/qrfun0828/user_resetmail_up.php</a>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            // 將驗證碼儲存到 session 中，以便在後續驗證中使用
            $_SESSION['reset_verification_code'] = $code;
            $_SESSION['user_mail'] = $email;
?>
            <script language="JavaScript">
                alert("寄送至電子郵件了(如未看到請翻閱垃圾郵件)");
                //window.history.back(-1)
                <?php
                    echo "location.href='user_resetmail_form.php?mail=$email'";
                ?>
            </script>
        <?php
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } 

?>