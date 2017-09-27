<?php
session_start();
header("Content-type: text/html; charset=utf-8"); 
require('safe.php');

if(!isset($_SESSION['realname'])) {
    echo "<script> alert('未登录或会话超时，请重新登陆。'); window.top.location.href = 'login.php'; </script>";
}

if (isset($_POST['doPost']) and $_POST['doPost'] == "true") {
    $database = mysqli_connect("localhost", "jet", "mima")
    or die("无法连接到数据库，请联系jet@pku.edu.cn.");

    mysqli_select_db($database, "test_register")
    or die("无法选择数据库，请联系jet@pku.edu.cn.");

    mysqli_query($database, "SET NAMES UTF8");

    $idcardnum = $_SESSION['idcardnum'];
    $query = "SELECT Students.passhash FROM Students WHERE idcardnum = '$idcardnum';";
    $result = mysqli_query($database, $query);
    $row = mysqli_fetch_array($result);

    $curpasshash = $row['passhash'];
    $p_passhash = hash("sha256", $_POST['curpassword']);
    if ($curpasshash == $p_passhash and $_POST['newpassword'] == $_POST['newpasswordc']) {
        $newpasshash = hash("sha256", $_POST['newpassword']);
        $query = "UPDATE Students SET passhash = '$newpasshash' WHERE idcardnum='$idcardnum';";
        $result = mysqli_query($database, $query);
        echo "<script> alert('密码修改成功！'); window.top.location.href = 'info.php'; </script>";
        exit();
    } else {
        echo "<script> alert('原密码输入错误！');</script>";
    }
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>中国大学先修课（AC）考试报名平台</title>
    <link href="./static/style.css" rel="stylesheet" type="text/css">
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
                    <li><a id="Nav_begin" class="leftNav_li" href="info.php">个人信息</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="application.php">报名考试</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="withdraw.php">取消考试</a></li>
                    <li><a id="Nav_application" class="leftNav_li_selected" href="change_password.php">修改密码</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="logout.php">退出登录</a></li>
                </ul>
            </div>
            <div class="rightContent">
                <form action="#" method="post" name="form1" enctype="multipart/form-data" onsubmit="return checkForm();">
                        <input type="hidden" name="doPost" value="true">


                        <table class=app_table>
                            <tr>
                                <td align="left" class="text12">
                                    <span class="text14b">说明：</span>
                                    <br>（1）
                            </tr>
                        </table>

                        <table class=app_table>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">修改密码</td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">当前密码</td>
                                <td align="left" class="text12"><input type="password" class="app_table_input" name="curpassword" size="40"><br></td>         
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">新密码</td>
                                <td align="left" class="text12"><input type="password" class="app_table_input" name="newpassword" id="np" size="40"><br></td>         
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">确认新密码</td>
                                <td align="left" class="text12"><input type="password" class="app_table_input" name="newpasswordc" id="npc" size="40"><br></td>         
                            </tr>
                            <tr>
                                <td align="center" colspan=2><input value="修改密码" type="submit" class="submit_button"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            <div class="clear"></div>
        </div>
    </div>

    <script>
     function checkForm() {
        if (document.getElementById('np').value != document.getElementById('npc').value) {
            alert("两次输入密码不一致"); 
            document.getElementById('np').value = "";
            document.getElementById('npc').value = "";
            document.getElementById('np').focus();
            return false;
        } else if (6 > document.getElementById('np').value.length) {
            alert("您的新密码长度过短");
            document.getElementById('np').focus();
            return false;
        }
        return true;
     }
    </script>

    <div class="foot">
        <div class="footer">
            <div class="copyright">
                北京大学考试研究院&nbsp;&nbsp;　|　联系方式：jzm@pku.edu.cn<br>
            </div>
        </div>
    </div>
</body>
</html>