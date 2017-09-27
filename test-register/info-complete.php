<?php
session_start();

header("Content-type: text/html; charset=utf-8"); 
require('safe.php');

if(!isset($_SESSION['realname'])) {
    echo "<script> alert('未登录或会话超时，请重新登陆。'); window.top.location.href = 'login.php'; </script>";
}

if ($_SESSION['detailed'] != 0) {
    echo "<script> alert('您已经填写过完整信息！'); window.top.location.href = 'info.php'; </script>";
}

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

if (isset($_POST['doPost']) and $_POST['doPost'] == "true") {
    $gender = prep($_POST['gender']);;
    $birthy = prep($_POST['birth_year']);;
    $birthm = prep($_POST['birth_month']);;
    $birthd = prep($_POST['birth_day']);;
    $eth = prep($_POST['minzu']);;
    $pstate = prep($_POST['zzmm']);;
    $email = prep($_POST['email']);;
    $qqnum = prep($_POST['qqnum']);;
    $stuprov = prep($_POST['province']);;
    $stutesttype = prep($_POST['xueke']);;
    $classid = prep($_POST['classid']);;
    $gradyear = prep($_POST['graduate_year']);;
    $stutype = prep($_POST['kslb']);;
    $foreigntype = prep($_POST['flanguage']);;
    $award1 = prep($_POST['award1']);;
    $award2 = prep($_POST['award2']);;
    $award3 = prep($_POST['award3']);;
    $jhrel = prep($_POST['jhrel']);;
    $jhname = prep($_POST['jhname']);;
    $jhworkplace = prep($_POST['jhwp']);;
    $jhworkpos = prep($_POST['jhwpo']);;
    $jhedu = prep($_POST['family1_education']);;
    $jhtel = prep($_POST['jhtel']);;

    $database = mysqli_connect("localhost", "jet", "mima")
    or die("无法连接到数据库，请联系   jet@pku.edu.cn. err1");
    
    mysqli_select_db($database, "test_register")
    or die("无法选择数据库，请联系   jet@pku.edu.cn. err2");

    mysqli_query($database, "SET NAMES UTF8");
    
    $idcardnum = $_SESSION['idcardnum'];

    $query = <<<EOF
UPDATE Students SET 
gender = '$gender', 
birthy = '$birthy', 
birthm = '$birthm', 
birthd = '$birthd', 
eth = '$eth', 
pstate = '$pstate', 
email = '$email', 
qqnum = '$qqnum', 
stuprov = '$stuprov', 
stutesttype = '$stutesttype', 
classid = '$classid', 
gradyear = '$gradyear', 
stutype = '$stutype', 
foreigntype = '$foreigntype', 
award1 = '$award1', 
award2 = '$award2', 
award3 = '$award3', 
jhrel = '$jhrel', 
jhname = '$jhname', 
jhworkplace = '$jhworkplace', 
jhworkpos = '$jhworkpos', 
jhedu = '$jhedu', 
jhtel = '$jhtel' 
WHERE idcardnum='$idcardnum';
EOF;

    $result = mysqli_query($database, $query)
    or die("无法访问数据库-100，请联系jet@pku.edu.cn.");

    $query = "UPDATE Students SET detailed = '1' WHERE idcardnum='$idcardnum';";
    $result = mysqli_query($database, $query)
    or die("无法访问数据库-101，请联系jet@pku.edu.cn.");
    $_SESSION['detailed'] = 1;

    echo "<script> alert('信息补全完成！'); window.top.location.href = 'info.php'; </script>";

}

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="static/style.css" rel="stylesheet" type="text/css">
    <script src="./static/info-complete.js"></script>
    <title>中国大学先修课（AC）考试报名平台</title>

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
                        <li><a class="leftNav_li_selected" href="#">个人信息补充</a></li>
                        <li><a class="leftNav_li" href="logout.php">退出登陆</a></li>
                        <!-- <li><span class=leftNav_block></span></li> -->
                    </ul>
                </div>
                <div class="rightContent">
                    <form method="post" name="form1" enctype="multipart/form-data" onsubmit="return checkdinfo();">
                        <input type="hidden" name="doPost" value="true">


                        <table class=app_table>
                            <tr>
                                <td align="left" class="text12">
                                    <span class="text14b">信息补充填写说明：</span>
                                    <br>（1）请认真填写以下补充信息，提交后将无法修改</font>
                                    <br>（2）请务必保证您填写的信息真实准确，否则后果自负
                            </tr>
                        </table>

                        <table class=app_table>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">个人信息</td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">姓名</td>
                                <td align="left" class="text12"><?php echo $_SESSION['realname']; ?></td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">身份证号码</td>
                                <td align="left" class="text12"><?php echo $_SESSION['idcardnum']; ?></td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">性別</td>
                                <td align="left" class="text12">
                                    <input type="radio" name="gender" value="0" checked>男&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="gender" value="1">女</td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">出生日期</td>
                                <td align="left" nowrap class="text12">
                                    <select name="birth_year" class="app_table_input_auto">
                                        <option value=2011>2011</option><option value=2010>2010</option><option value=2009>2009</option><option value=2008>2008</option><option value=2007>2007</option><option value=2006>2006</option><option value=2005>2005</option><option value=2004>2004</option><option value=2003>2003</option><option value=2002>2002</option><option value=2001>2001</option><option value=2000>2000</option><option value=1999>1999</option><option value=1998>1998</option><option value=1997>1997</option><option value=1996>1996</option><option value=1995>1995</option><option value=1994>1994</option><option value=1993>1993</option>
                                    </select>年&nbsp;&nbsp;
                                    <select name="birth_month" class="app_table_input_auto">
                                        <option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option>
                                    </select>月&nbsp;&nbsp;
                                    <select name="birth_day" class="app_table_input_auto">
                                        </option><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option>
                                    </select>日&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">民族</td>
                                <td align="left" class="text12"><select name="minzu" class="app_table_input_auto">
                                    <option value='汉族'>汉族</option><option value='蒙古族'>蒙古族</option><option value='回族'>回族</option><option value='藏族'>藏族</option><option value='维吾尔族'>维吾尔族</option><option value='苗族'>苗族</option><option value='彝族'>彝族</option><option value='朝鲜族'>朝鲜族</option><option value='满族'>满族</option><option value='瑶族'>瑶族</option><option value='黎族'>黎族</option><option value='高山族'>高山族</option><option value='壮族'>壮族</option><option value='布依族'>布依族</option><option value='侗族'>侗族</option><option value='白族'>白族</option><option value='哈萨克族'>哈萨克族</option><option value='哈尼族'>哈尼族</option><option value='傣族'>傣族</option><option value='傈僳族'>傈僳族</option><option value='侗族'>侗族</option><option value='东乡族'>东乡族</option><option value='纳西族'>纳西族</option><option value='拉古族'>拉古族</option><option value='水族'>水族</option><option value='景颇族'>景颇族</option><option value='柯尔克孜族'>柯尔克孜族</option><option value='土族'>土族</option><option value='塔吉克族'>塔吉克族</option><option value='乌孜别克族'>乌孜别克族</option><option value='塔塔尔族'>塔塔尔族</option><option value='鄂温克族'>鄂温克族</option><option value='保安族'>保安族</option><option value='羌族'>羌族</option><option value='撒拉族'>撒拉族</option><option value='俄罗斯族'>俄罗斯族</option><option value='锡伯族'>锡伯族</option><option value='裕固族'>裕固族</option><option value='鄂伦春族'>鄂伦春族</option><option value='土家族'>土家族</option><option value='畲族'>畲族</option><option value='达斡尔族'>达斡尔族</option><option value='么佬族'>么佬族</option><option value='布朗族'>布朗族</option><option value='仡佬族'>仡佬族</option><option value='阿昌族'>阿昌族</option><option value='普米族'>普米族</option><option value='怒族'>怒族</option><option value='德昂族'>德昂族</option><option value='京族'>京族</option><option value='独龙族'>独龙族</option><option value='赫哲族'>赫哲族</option><option value='门巴族'>门巴族</option><option value='毛南族'>毛南族</option><option value='哈巴族'>哈巴族</option><option value='基诺族'>基诺族</option>		</select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">政治面貌</td>
                                <td align="left" class="text12">
                                    <input type="radio" name="zzmm" value="中共党员"> 中共党员&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="zzmm" value="中共预备党员"> 中共预备党员&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="zzmm" value="共青团员"> 共青团员&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="zzmm" value="群众" checked> 群众&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="zzmm" value="其他"> 其他
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">电子邮箱</td>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="email" id="email" size="40" value=""></td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">QQ号</td>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="qqnum" id="qqnum" size="40" value=""></td>
                            </tr>
                            

                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">教育信息</td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12">生源省市</td>
                                <td  align="left" class="text12">请选择您的生源省市（您参加高考的省市）</td>
                            </tr>
                            <tr>
                                <td  align="left" class="text12"><select name="province" class="app_table_input">
                                    <option value='北京'>北京</option><option value='天津'>天津</option><option value='上海'>上海</option><option value='重庆'>重庆</option><option value='广东'>广东</option><option value='河北'>河北</option><option value='山西'>山西</option><option value='内蒙古'>内蒙古</option><option value='辽宁'>辽宁</option><option value='吉林'>吉林</option><option value='黑龙江'>黑龙江</option><option value='江苏'>江苏</option><option value='浙江'>浙江</option><option value='安徽'>安徽</option><option value='福建'>福建</option><option value='江西'>江西</option><option value='山东'>山东</option><option value='河南'>河南</option><option value='湖北'>湖北</option><option value='湖南'>湖南</option><option value='广西'>广西</option><option value='海南'>海南</option><option value='四川'>四川</option><option value='贵州'>贵州</option><option value='云南'>云南</option><option value='西藏'>西藏</option><option value='陕西'>陕西</option><option value='甘肃'>甘肃</option><option value='青海'>青海</option><option value='宁夏'>宁夏</option><option value='新疆'>新疆</option>		</select>                
                                </td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12">学科</td>
                                <td  align="left" class="text12">对于未分文理科的学生，请选择您的主修方向，浙江上海等自选科目地区请选择“综合改革”</td>
                            </tr>
                            <tr>
                                <td  align="left" class="text12">
                                    <input type="radio" name="xueke" value="0" checked>理科&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="xueke" value="1">文科&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="xueke" value="2">综合改革
                                </td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">学校</td>
                                <td align="left" class="text12"><?php echo $_SESSION['schoolname']; ?></td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">年级</td>
                                <td align="left" class="text12"><?php echo $grade_list[(int)$_SESSION['grade']]; ?></td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">班级</td>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="classid" id="classid" size="8" value=""></td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">毕业时间</td>
                                <td align="left" nowrap class="text12"><select name="graduate_year" class="app_table_input_auto">
                                    <option value=2020>2020</option><option value=2019>2019</option><option value=2018>2018</option><option value=2017>2017</option><option value=2016>2016</option></select>年
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">考生类别</td>
                                <td align="left" class="text12"><select name="kslb" class="app_table_input_auto">
                                    <option value=0>城市应届</option><option value=1>城市往届</option><option value=2>农村应届</option><option value=3>农村往届</option>		</select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12">外语语种</td>
                                <td align="left" class="text12"><select name="flanguage" class="app_table_input_auto">
                                    <option value='英语'>英语</option><option value='日语'>日语</option><option value='德语'>德语</option><option value='法语'>法语</option><option value='俄语'>俄语</option><option value='西班牙语'>西班牙语</option><option value='朝鲜语'>朝鲜语</option><option value='其他语种'>其他语种</option>		</select>
                                </td>
                            </tr>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">获奖信息</td>
                            </tr>
                            <tr>
                                <td rowspan=4 width=25% align="right" class="text12">个人获奖信息</td>
                                <td  align="left" class="text12">请按重要程度依次列出您的获奖情况（可留空）</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="award1" value=""></td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="award2" value=""></td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="award3" value=""></td>
                            </tr>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">监护人信息</td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">与本人关系</td>
                                <td align="left" class="text12">
                                    <input type="text" class="app_table_input" name="jhrel" value="">
                                </td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">姓名</td>
                                <td align="left" class="text12">
                                    <input type="text" class="app_table_input" name="jhname" value="">
                                </td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">工作单位</td>
                                <td align="left" class="text12">
                                    <input type="text" class="app_table_input" name="jhwp" value="">
                                </td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">职务</td>
                                <td align="left" class="text12">
                                    <input type="text" class="app_table_input" name="jhwpo" value="">
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="text12" >最高学历</td>
                                <td align="left" class="text12"><select name="family1_education" class="app_table_input_auto">
                                    <option value='博士研究生'>博士研究生</option><option value='硕士研究生'>硕士研究生</option><option value='大学本科'>大学本科</option><option value='大学专科'>大学专科</option><option value='高中'>高中</option><option value='中专'>中专</option><option value='技校'>技校</option><option value='初中'>初中</option><option value='小学'>小学</option><option value='其它'>其它</option>		</select>
                                </td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12">联系电话</td>
                                <td align="left" class="text12">
                                    <input type="text" class="app_table_input" name="jhtel" value="">
                                </td>
                            </tr>
                            <input type="hidden" name="doPost" value="true">
                            <tr>
                                <td align="center" colspan=2><input value="提交信息" type="submit" class="submit_button"></td>
                            </tr>
                        </table>
                    </form>
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