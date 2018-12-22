function submitcheck() {
	if (checkid()&&checkengname())
	return true;
	else
	return false;
}

function checkid() {
	if(document.memadd.mem_id.value == "") {
		alert("請輸入會員號碼！");
		return false;
	}
	if(parseInt(document.memadd.mem_id.value) != document.memadd.mem_id.value) {
		alert("會員號碼應該為一個整數！");
		return false;
	}
	return true;
}

function checkengname() {
	if(document.memadd.mem_name_eng.value == "") {
		alert("請輸入會員英文姓名！");
		return false;
	}
	return true;
}

function checkchiname() {
	if(document.memadd.mem_name_chi.value == "") {
		alert("請輸入會員中文姓名！");
		return false;
	}
	return true;
}

function checkhkid() {
	if(document.memadd.mem_hkid.value == "") {
		alert("請輸入會員身份証號碼！");
		return false;
	}
	if(document.memadd.mem_hkid.value.length != 10) {
		alert("會員身份証號碼格式不正確！\n正確格式： Z123456(7)");
		return false;
	}
	return true;
}
