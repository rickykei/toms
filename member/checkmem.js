function submitcheck() {
	if (checkid()&&checkengname())
	return true;
	else
	return false;
}

function checkid() {
	if(document.memadd.mem_id.value == "") {
		alert("�п�J�|�����X�I");
		return false;
	}
	if(parseInt(document.memadd.mem_id.value) != document.memadd.mem_id.value) {
		alert("�|�����X���Ӭ��@�Ӿ�ơI");
		return false;
	}
	return true;
}

function checkengname() {
	if(document.memadd.mem_name_eng.value == "") {
		alert("�п�J�|���^��m�W�I");
		return false;
	}
	return true;
}

function checkchiname() {
	if(document.memadd.mem_name_chi.value == "") {
		alert("�п�J�|������m�W�I");
		return false;
	}
	return true;
}

function checkhkid() {
	if(document.memadd.mem_hkid.value == "") {
		alert("�п�J�|�����������X�I");
		return false;
	}
	if(document.memadd.mem_hkid.value.length != 10) {
		alert("�|�����������X�榡�����T�I\n���T�榡�G Z123456(7)");
		return false;
	}
	return true;
}
