<?php
header("Content-type: text/html; charset=utf-8"); 

require('safe.php');

$realname = prep($_POST['realname']);
$idcardnum = prep($_POST['idcardnum']);
$phonenum = prep($_POST['phonenum']);
$schoolname = prep($_POST['schoolname']);
$password = prep($_POST['password']);
$grade = prep($_POST['grade']);
$exampid = prep($_POST['exampid']);

$database = mysqli_connect("localhost", "jet", "mima")
or die("无法连接到数据库，请联系jet@pku.edu.cn.");

mysqli_select_db($database, "test_register")
or die("无法选择数据库，请联系jet@pku.edu.cn.");

mysqli_query($database, "SET NAMES UTF8");

$registered = false;
$query = "SELECT Students.UID FROM Students WHERE Students.idcardnum='$idcardnum';";
mysqli_query($database, "SET NAMES utf8mb4");
$result = mysqli_query($database, $query)
or die("无法访问数据库-1，请联系jet@pku.edu.cn.");
if (mysqli_num_rows($result) != 0) {
    $registered = true;
    echo "<script> alert('您已经注册，请直接登陆，如有问题请联系我们。'); window.top.location.href = 'login.php'; </script>";
    exit();
}
$passhash = hash("sha256", $password);
$query = "INSERT INTO Students(realname, idcardnum, phonenum, schoolname, grade, exampid, passhash) VALUES('$realname', '$idcardnum', '$phonenum', '$schoolname', '$grade', '$exampid', '$passhash');";
mysqli_query($database, $query)
or die("无法访问数据库-2，请联系jet@pku.edu.cn.");

// echo $_FILES['file']['tmp_name'] . '\n';
// echo "./uploaded_files/" . "$idcardnum" . ".jpg" . '\n';
move_uploaded_file($_FILES["file"]["tmp_name"],  "./uploaded_photos/" . "$idcardnum" . ".jpg") 
or die("无法保存您的照片，请联系jet@pku.edu.cn.");

$grade_list = array('其他', '高一', '高二', '高三');
$examp_list = array(
    'error', 
    '北京大学附属中学',
    '大连育明高级中学',
    '山东省青岛第二中学',
    '西北工业大学附属中学',
    '华东师范大学第二附属中学',
    '湖南省长沙市第一中学', 
    '重庆市第一中学',
    '深圳市第二实验学校'
);


?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>中国大学先修课（AC）考试报名平台</title>
    <link href="./static/style.css" rel="stylesheet" type="text/css">

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
                        <li><a class="leftNav_li" href="login.php">登录</a></li>
                        <li><a class="leftNav_li_selected" href="register.php">注册</a></li>
                    </ul>
                </div>
                <div class="rightContent">
                    <script>
                        alert('注册成功！请返回登录页面登录报名平台。');
                    </script>
                    <table class=app_table>
                        <tr align="left" bgcolor="#F0F0F0">
                            <td colspan="2" class="text14b">注册成功</td>
                        </tr>
                        <tr>
                            <td colspan="10" align="center" class="text12">注册成功！以下为您的账户信息：<br> （如有错误请联系我们修改） </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>姓名</td>
                            <td align="left" class="text12">
                            <?php
                                echo "$realname";
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>身份证号码</td>
                            <td align="left" class="text12">
                            <?php
                                echo "$idcardnum";
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>手机号码</td>
                            <td align="left" class="text12">
                            <?php
                                echo "$phonenum";
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>学校</td>
                            <td align="left" class="text12">
                            <?php
                                echo "$schoolname";
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>年级</td>
                            <td align="left" class="text12">
                            <?php
                                echo $grade_list[(int)$grade];
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>考点</td>
                            <td align="left" class="text12">
                            <?php
                                echo $examp_list[(int)$exampid];
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan=2><input type="button" value="返回登录页面" class="submit_button" onclick="window.top.location.href = 'login.php';"></td>
                        </tr>
                    </table>

                    <!--end -->
                </div>
                <div class="clear"></div>
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