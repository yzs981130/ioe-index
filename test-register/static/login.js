//function refresh_image() {
//    var d = new Date();
//    document.getElementById("captcha_image").src = 'captcha.php?' + d.getTime();
//}

function trim(text) {
    return text.replace(/^\s+/, "").replace(/\s+$/, "");
}

function LoginCheck() {
    if (document.getElementById('username').value == '请输入身份证号' || trim(document.getElementById('username').value) == '') {
        alert("请输入身份证号码");
        document.getElementById('username').focus();
        return false;
    } else if (document.getElementById('password').value == '请输入密码' || trim(document.getElementById('password').value) == '') {
        alert("请输入密码");
        document.getElementById('password_shadow').focus();
        return false;
        //} else if (document.getElementById('captcha').value == '请输入验证码' || trim(document.getElementById('captcha').value) == '') {
        //    alert("请输入验证码");
        //    document.getElementById('captcha').focus();
        //    return false;
    } else {
        return true;
    }
}

function focus_password() {
    document.getElementById('password').style.display = "block";
    document.getElementById('password_shadow').style.display = "none";
    document.getElementById('password').focus();
}

function blur_password() {
    if (document.getElementById('password').value == '') {
        document.getElementById('password_shadow').style.display = "block";
        document.getElementById('password').style.display = "none";
    }
}