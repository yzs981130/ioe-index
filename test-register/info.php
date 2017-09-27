<?php
session_start();

header("Content-type: text/html; charset=utf-8"); 
require('safe.php');

if(!isset($_SESSION['realname'])) {
    echo "<script> alert('未登录或会话超时，请重新登陆。'); window.top.location.href = 'login.php'; </script>";
}

if ($_SESSION['detailed'] == 0) {
    echo "<script> alert('首次登陆，需要您补充个人信息！'); window.top.location.href = 'info-complete.php'; </script>";
}

$subject = $_SESSION['subject'];

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
                    <li><a id="Nav_begin" class="leftNav_li_selected" href="info.php">个人信息</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="application.php">报名考试</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="withdraw.php">取消考试</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="change_password.php">修改密码</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="logout.php">退出登录</a></li>
                </ul>
            </div>
            <div class="rightContent">
                <table class=app_table>
                    <tr align="left" bgcolor="#F0F0F0">
                        <td colspan="2" class="text14b">您的个人基本信息</td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">姓名</td>
                        <td align="left" class="text12">
                        <?php
                            echo $_SESSION['realname'];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">身份证号码</td>
                        <td align="left" class="text12">
                        <?php
                            echo $_SESSION['idcardnum'];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">手机号码</td>
                        <td align="left" class="text12">
                        <?php
                            echo $_SESSION['phonenum'];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">学校</td>
                        <td align="left" class="text12">
                        <?php
                            echo $_SESSION['schoolname'];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">年级</td>
                        <td align="left" class="text12">
                        <?php
                            echo $grade_list[(int)$_SESSION['grade']];
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=25% align="right" class="text12">考点</td>
                        <td align="left" class="text12">
                        <?php
                            echo $examp_list[(int)$_SESSION['exampid']];
                        ?>
                        </td>
                    </tr>
                </table>
                <table class="app_table">
                    <tr align="left" bgcolor="#F0F0F0">
                        <td colspan="9" class="text14b">您的考试报名情况</td>
                    </tr>
                    <tr>
                        <td width=10% align="center" class="text12">微积分（一）</td>
                        <td width=10% align="center" class="text12">微积分（二）</td>
                        <td width=10% align="center" class="text12">电磁学</td>
                        <td width=10% align="center" class="text12">大学化学</td>
                        <td width=10% align="center" class="text12">计算概论（上机）</td>
                        <td width=10% align="center" class="text12">电路基础</td>
                        <td width=10% align="center" class="text12">中国通史（古代部分）</td>
                        <td width=10% align="center" class="text12">中国古代文化</td>
                        <td width=10% align="center" class="text12">地球科学概论</td>
                    </tr>
                    <tr>
                        <?php
                            for ($i = 0; $i < 9; $i++) {
                                echo '<td align="center" class="text12">';
                                if ($subject[$i] == "0") {
                                    echo "<font color=red><b>未报名</b></font>";
                                } else if ($subject[$i] == "1") {
                                    echo "<font color=orange><b>待审核</b></font>";
                                } else if ($subject[$i] == "2") {
                                    echo "<font color=green><b>已审核</b></font>";
                                } else {
                                    echo "<script> alert('个人数据错误，请联系我们！sub=$subject,i=$i'); window.top.location.href = 'logout.php'; </script>";
                                    die('0');
                                }
                                echo '</td>';
                            }
                        ?>
                    </tr>
                </table>
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