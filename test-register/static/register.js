function checkNumber(number) {
    var isNumber = true;
    if (number == "") {
        return false;
    }
    for (i = 0; i < number.length; i++) {
        if (number.charAt(i) != "0" && !parseInt(number.charAt(i))) {
            isNumber = false;
            break;
        }
    }
    return isNumber;
}

function trim(text) {
    return text.replace(/^\s+/, "").replace(/\s+$/, "");
}

function checkIdcard(idcard) {
    var area = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江",
        31: " 上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北",
        43: " 湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏",
        61: " 陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "新疆",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外"
    }

    var idcard, Y, JYM;
    var S, M;
    var idcard_array = new Array();
    idcard_array = idcard.split("");
    /*地区检验*/
    if (area[parseInt(idcard.substr(0, 2))] == null) {
        return false;
    }

    bornyear = parseInt(idcard.substr(6, 4));
    if (bornyear < 1995) {
        return false;
    }

    /*身份号码位数及格式检验*/
    switch (idcard.length) {

        case 18:
            //计算校验位 
            S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7 +
                (parseInt(idcard_array[1]) + parseInt(idcard_array[11])) * 9 +
                (parseInt(idcard_array[2]) + parseInt(idcard_array[12])) * 10 +
                (parseInt(idcard_array[3]) + parseInt(idcard_array[13])) * 5 +
                (parseInt(idcard_array[4]) + parseInt(idcard_array[14])) * 8 +
                (parseInt(idcard_array[5]) + parseInt(idcard_array[15])) * 4 +
                (parseInt(idcard_array[6]) + parseInt(idcard_array[16])) * 2 +
                parseInt(idcard_array[7]) * 1 +
                parseInt(idcard_array[8]) * 6 +
                parseInt(idcard_array[9]) * 3;
            Y = S % 11;
            M = "F";
            JYM = "10X98765432";
            M = JYM.substr(Y, 1); /*判断校验位*/
            if (M == idcard_array[17]) {
                return true; /*检测ID的校验位*/
            } else {
                return false;
            }
            break;

        default:
            return false;

    }
}

function checkPhonenum(phonenum) {
    var p = phonenum.toString();
    if (p.length != 11 || p[0] != '1')
        return false;
    return true;
}

function checkForm() {
    for (var i = 0; i < 9; i++) {
        document.form1.elements[i].value = trim(document.form1.elements[i].value);
    }
    document.form1.idcardnum.value = document.form1.idcardnum.value;
    if ("" == document.form1.elements[1].value) {
        alert("请填写您的姓名");
        document.form1.elements[1].focus();
        return false;
    } else if ("" == document.form1.elements[2].value) {
        alert("请填写您的身份证号码");
        document.form1.elements[2].focus();
        return false;
    } else if (!checkIdcard(document.form1.elements[2].value)) {
        alert("您填写的身份证号码有误，请检查");
        document.form1.elements[2].focus();
        return false;
    } else if ("" == document.form1.elements[3].value) {
        alert("请填写您的手机号码");
        document.form1.elements[3].focus();
        return false;
    } else if (!checkPhonenum(document.form1.elements[3].value)) {
        alert("您填写的手机号码有误，请检查");
        document.form1.elements[3].focus();
        return false;
    } else if ("" == document.form1.elements[4].value) {
        alert("请填写您的学校");
        document.form1.elements[4].focus();
        return false;
    } else if ("" == document.form1.elements[7].value) {
        alert("请输入您的密码");
        document.form1.elements[7].focus();
        return false;
    } else if (6 > document.form1.elements[7].value.length) {
        alert("您的密码长度过短");
        document.form1.elements[7].focus();
        return false;
    } else if ("" == document.form1.elements[8].value) {
        alert("请再次输入您的密码");
        document.form1.elements[8].focus();
        return false;
    } else if (document.form1.elements[7].value != document.form1.elements[8].value) {
        alert("两次输入密码不一致"); {
            document.form1.elements[7].value = "";
            document.form1.elements[8].value = "";
            document.form1.elements[7].focus();
        }
        return false;
    } else if (document.form1.elements[9].files.length <= 0) {
        alert("请上传您的照片");
        return false;
    }
    return true;
}