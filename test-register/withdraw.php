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
    $query = "SELECT Students.subject FROM Students WHERE idcardnum = '$idcardnum';";
    $result = mysqli_query($database, $query);
    $row = mysqli_fetch_array($result);

    $_SESSION['subject'] = $row['subject'];
    $subject = $_SESSION['subject'];

    $new_sub = (int)$_POST['subjectt'];
    if ($subject[$new_sub] != '1') {
        echo "<script> alert('您未报名该课程或课程状态有误！如有问题请联系我们。');</script>";
    } else {
        $subject[$new_sub] = '0';
        
        $query = "UPDATE Students SET subject = '$subject' WHERE idcardnum='$idcardnum';";
        $result = mysqli_query($database, $query)
        or die("无法访问数据库-100，请联系jet@pku.edu.cn.");

        $_SESSION['subject'] = $subject;
        
        echo "<script> alert('成功取消考试！'); window.top.location.href = 'info.php'; </script>";
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
                    <li><a id="Nav_application" class="leftNav_li_selected" href="withdraw.php">取消考试</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="change_password.php">修改密码</a></li>
                    <li><a id="Nav_application" class="leftNav_li" href="logout.php">退出登录</a></li>
                </ul>
            </div>
            <div class="rightContent">
                    <form method="post" name="form1" enctype="multipart/form-data" onSubmit="JavaScript: return checkForm();">
                        <input type="hidden" name="doPost" value="true">


                        <table class=app_table>
                            <tr>
                                <td align="left" class="text12">
                                    <span class="text14b">说明：</span>
                                    <br>（1）
                                    <br>（2）
                            </tr>
                        </table>

                        <table class=app_table>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">取消考试</td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>报考科目</td>
                                <td  align="left" class="text12">请选择您要取消的课程</td>
                            </tr>
                            <tr>
                                <td  align="left" class="text12">
                                    <select name="subjectt" class="app_table_input">
                                        <option value=0>微积分（一）</option>
                                        <option value=1>微积分（二）</option>
                                        <option value=2>电磁学</option>
                                        <option value=3>大学化学</option>
                                        <option value=4>计算概论（上机）</option>
                                        <option value=5>电路基础</option>
                                        <option value=6>中国通史（古代部分）</option>
                                        <option value=7>中国古代文化</option>
                                        <option value=8>地球科学概论</option>
                                    </select>                
                                </td>
                            </tr>
                            <!-- <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>学习证明</td>
                                <td align="left" class="text12">请上传该课程的学习证明</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="file" class="app_table_input" name="file" id="file"><br></td>
                            </tr> -->
                            <tr>
                                <td align="center" colspan=2><input value="取消考试申请" type="submit" class="submit_button"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            <div class="clear"></div>
        </div>
    </div>

    <script>
     function checkForm() {
         /*if (document.form1.elements[2].files.length <= 0) {
             alert('请附加您的学习证明文件！');
             return false;
         }*/
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