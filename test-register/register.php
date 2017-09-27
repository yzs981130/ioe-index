<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="static/style.css" rel="stylesheet" type="text/css">
    <script src="./static/register.js"></script>
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
                        <li><a class="leftNav_li" href="login.php">登录</a></li>
                        <li><a class="leftNav_li_selected" href="register.php">注册</a></li>
                        <li><span class=leftNav_block></span></li>
                        <li><a class="leftNav_li" href="http://www.ioe.pku.edu.cn">IOE主页</a></li>
                        <!-- <li><span class=leftNav_block></span></li> -->
                    </ul>
                </div>
                <div class="rightContent">
                    <form action="register_confirm.php" method="post" name="form1" enctype="multipart/form-data" onsubmit="return checkForm();">
                        <input type="hidden" name="doPost" value="true">


                        <table class=app_table>
                            <tr>
                                <td align="left" class="text12">
                                    <span class="text14b">填写说明：</span>
                                    <br>（1）请认真填写下表信息，这些基本信息注册后不可修改，每个身份证号码在本系统只可注册一次。</font>
                                    <br>（2）“<span class="bitian">*</span>”为必填项。
                            </tr>
                        </table>

                        <table class=app_table>
                            <tr align="left" bgcolor="#F0F0F0">
                                <td colspan="2" class="text14b">新用户注册</td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>姓名</td>
                                <td align="left" class="text12">请务必输入您的真实中文姓名，且必须和身份证上的姓名完全一致</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="realname" size="40"><br></td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>身份证号码</td>
                                <td align="left" class="text12">请填写您的身份证号，<b>末位为X的请大写</b>。</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="idcardnum" size="40"><br></td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>手机号码</td>
                                <td align="left" class="text12">请填写您的手机号，方便我们后续联系。</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="phonenum" size="40"><br></td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>学校</td>
                                <td align="left" class="text12">请完整您的学校名称（附加省市名）</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="text" class="app_table_input" name="schoolname" size="40"><br></td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>年级</td>                            
                                <td align="left" class="text12">
                                <select name="grade" class="app_table_input">
                                        <option value=1>高一</option>
                                        <option value=2>高二</option>
                                        <option value=3>高三</option>
                                        <option value=0>其他</option>
                                    </select>   
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>考点</td>
                                <td align="left" class="text12">请选择您的考点</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12">
                                    <select name="exampid" class="app_table_input">
                                        <option value=1>北京大学附属中学</option>
                                        <option value=2>大连育明高级中学</option>
                                        <option value=3>山东省青岛第二中学</option>
                                        <option value=4>西北工业大学附属中学</option>
                                        <option value=5>华东师范大学第二附属中学</option>
                                        <option value=6>湖南省长沙市第一中学</option>
                                        <option value=7>重庆市第一中学</option>
                                        <option value=8>深圳市第二实验学校</option>
                                    </select>   
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>密码</td>
                                <td align="left" class="text12">密码可由英文字母、数字、符号组成，长度不少于6个字符</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="password" class="app_table_input" name="password" size="40"><br></td>
                            </tr>
                            <tr>
                                <td width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>再次输入密码</td>
                                <td align="left" class="text12"><input type="password" class="app_table_input" name="confirmPassword" size="40"></td>
                            </tr>
                            <tr>
                                <td rowspan=2 width=25% align="right" class="text12"><span class="bitian">*&nbsp;</span>照片</td>
                                <td align="left" class="text12">请上传您的一寸免冠照片。</td>
                            </tr>
                            <tr>
                                <td align="left" class="text12"><input type="file" class="app_table_input" name="file" id="file"><br></td>
                            </tr>
                            <tr>
                                <td align="center" colspan=2><input value="提交注册信息" type="submit" class="submit_button"></td>
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