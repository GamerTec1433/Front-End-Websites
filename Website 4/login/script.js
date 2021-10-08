var loginForm = document.getElementById('login');
var regForm = document.getElementById('register');
var btnColor = document.getElementById('btn-color');
var	logReg = document.getElementById('log-reg');
var body = document.getElementById('body');

function Login(){
	loginForm.style.left = "30px";
	regForm.style.right = "480px";
	btnColor.style.left = "50px";
	btnColor.style.background = "linear-gradient(270deg, rgba(75,75,75,1) 0%, rgba(0,196,39,1) 100%)";
}

function Register(){
	loginForm.style.left = "480px";
	regForm.style.right = "30px";
	btnColor.style.left = "180px";
	btnColor.style.background = "linear-gradient(90deg, rgba(75,75,75,1) 0%, rgba(0,196,39,1) 100%)";
}

function checkEmpty(){
	if (loginForm.username.value == "" || loginForm.password.value == "")
	{
		return;
	}
	else
	{
		logReg.style.opacity = "0";
		logReg.style.zIndex = "-1";
		body.style.overflowY = "scroll";
	}
}

function checkEmpty2(){
	if (regForm.username.value == "" || regForm.email.value == "" || regForm.password.value == "")
	{
		return;
	}
	else
	{
		Login();
	}
}

function openLogin(){
	logReg.style.opacity = "1";
	logReg.style.zIndex = "3";
	body.style.overflowY = "hidden";
}