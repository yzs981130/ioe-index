function trim(text) {
    return text.replace(/^\s+/, "").replace(/\s+$/, "");
}

function checkPhonenum(phonenum) {
    var p = phonenum.toString();
    if (p.length != 11 || p[0] != '1')
        return false;
    return true;
}

function checkEmail(email) {
    var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    return myreg.test(email);
}

function checkdinfo() {
    for (var i = 0; i < 31; i++) {
        document.form1.elements[i].value = trim(document.form1.elements[i].value);
    }
    if ("" == document.getElementById('email').value) {
        alert("请填写您的电子邮箱");
        document.getElementById('email').focus();
        return false;
    } else if ("" == document.getElementById('qqnum').value) {
        alert("请填写您的QQ号");
        document.getElementById('qqnum').focus();
        return false;
    } else if ("" == document.getElementById('classid').value) {
        alert("请填写您的班级");
        document.getElementById('classid').focus();
        return false;
    } else if ("" == document.form1.elements[25].value) {
        alert("请填写您的监护人信息");
        document.form1.elements[25].focus();
        return false;
    } else if ("" == document.form1.elements[26].value) {
        alert("请填写您的监护人信息");
        document.form1.elements[26].focus();
        return false;
    } else if ("" == document.form1.elements[27].value) {
        alert("请填写您的监护人信息");
        document.form1.elements[27].focus();
        return false;
    } else if ("" == document.form1.elements[28].value) {
        alert("请填写您的监护人信息");
        document.form1.elements[28].focus();
        return false;
    } else if ("" == document.form1.elements[30].value) {
        alert("请填写您的监护人信息");
        document.form1.elements[30].focus();
        return false;
    } else if (!checkEmail(document.getElementById('email').value)) {
        alert("请检查您填写的电子邮箱");
        document.getElementById('email').focus();
        return false;
    } else if (!checkPhonenum(document.form1.elements[30].value)) {
        alert("请检查您填写的监护人电话");
        document.form1.elements[30].focus();
        return false;
    }

    return true;
}