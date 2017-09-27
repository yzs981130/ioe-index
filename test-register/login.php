<?php
require('safe.php');

if (isset($_POST['doLogin']) and $_POST['doLogin'] == "true") {
    $idcardnum = prep($_POST['idcardnum']);
    $password = prep($_POST['passw0rd']) ;
    $passhash = hash("sha256", $password);

    $database = mysqli_connect("localhost", "jet", "mima")
    or die("无法连接到数据库，请联系   jet@pku.edu.cn. err1");
    
    mysqli_select_db($database, "test_register")
    or die("无法选择数据库，请联系   jet@pku.edu.cn. err2");

    mysqli_query($database, "SET NAMES UTF8");
    
    $query = "SELECT Students.UID, Students.passhash FROM Students WHERE idcardnum = '$idcardnum';";
    $result = mysqli_query($database, $query);
    $ret = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($ret > 0 and $row['passhash'] == $passhash) {
        session_start();
        header("Content-type: text/html; charset=utf-8"); 

        $_SESSION['UID'] = $row['UID'];

        $query = "SELECT * FROM Students WHERE idcardnum = '$idcardnum';";
        $result = mysqli_query($database, $query);
        $row = mysqli_fetch_array($result);

        $_SESSION['realname'] = $row['realname'];
        $_SESSION['subject'] = $row['subject'];
        $_SESSION['idcardnum'] = $idcardnum;
        $_SESSION['phonenum'] = $row['phonenum'];
        $_SESSION['schoolname'] = $row['schoolname'];
        $_SESSION['grade'] = $row['grade'];
        $_SESSION['exampid'] = $row['exampid'];
        $_SESSION['detailed'] = (int)$row['detailed'];

        if ($_SESSION['detailed'] == 0) {
            echo "<script> alert('首次登陆，需要您补充个人信息！'); window.top.location.href = 'info-complete.php'; </script>";
        } else {
            echo "<script> window.top.location.href = 'info.php'; </script>";
        }
    } else if ($ret > 0) {
        header("Content-type: text/html; charset=utf-8");
        echo "<script> alert('该身份证已注册，但您输入的密码错误，请检查。如有问题请联系我们申诉。'); window.top.location.href = 'login.php'; </script>";
    } else {
        header("Content-type: text/html; charset=utf-8");
        echo "<script> alert('该身份证未注册，请检查，如有问题请联系我们。'); window.top.location.href = 'login.php'; </script>";
    }
}

?>


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="./static/style.css" rel="stylesheet" type="text/css">
    <script src="./static/login.js"></script>
    <title>中国大学先修课（AC）考试报名平台</title>
</head>

<body>
    <div class="header_logo">
        <div class="header_logo_con">
            <h1 class="h1_logo">中国大学先修课（AC）考试报名平台</h1>
        </div>
    </div>

    <div class="main">
        <div class="mainCon">
            <div class="leftNav">
                <ul>
                    <li><a class="leftNav_li_selected" href="login.php">登录</a></li>
                    <li><a class="leftNav_li" href="register.php">注册</a></li>
                    <li><span class=leftNav_block></span></li>
                    <li><a class="leftNav_li" href="http://www.ioe.pku.edu.cn">IOE主页</a></li>
                    <!-- <li><span class=leftNav_block></span></li> -->
                </ul>
            </div>
            <div class="rightLoginContent">
                <div class="loginBox">
                    <h2>用户登录</h2>
                    <form method="post" name="form1" onsubmit="return LoginCheck();">
                        <input type="hidden" name="doLogin" value="true">
                        <div>
                            <input type="text" id="idcardnum" name="idcardnum" class="inputBox" value="请输入身份证号" onfocus="if (value ==&#39;请输入身份证号&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;请输入身份证号&#39;}" title="请输入身份证号">
                        </div>
                        <div>
                            <input type="text" id="password_shadow" name="password_shadow" class="inputBox" value="请输入密码" title="请输入密码" onfocus="focus_password();">
                            <input type="password" id="password" name="passw0rd" class="inputBox" value="" title="请输入密码" onblur="blur_password();" style="display:none;">
                        </div>
                        <div>
                            <input type="submit" value="登 录" class="login_button">
                        </div>
                    </form>
                </div>

            </div>
            <div class="clear"></div>
            <br><br>
        </div>
    </div>

    <div class="foot">
        <div class="footer">
            <div class="copyright">
                北京大学考试研究院&nbsp;&nbsp;　|　联系方式：jzm@pku.edu.cn<br>
            </div>
        </div>
    </div>
</body>
</html>