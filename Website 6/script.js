var button = document.getElementById('nav-bar-lines');
var button2 = document.getElementById('nav-bar-lines2');
var navBar = document.getElementById('nav-bar');

var aboutBox = document.getElementById('about-box');
var aboutHeader = document.getElementById('about-header');
var navFixed = document.getElementById('navFixed');

var NeedTo1 = document.getElementById('NeedTo1');
var NeedTo2 = document.getElementById('NeedTo2');
var NeedToChild1 = document.getElementById('NeedTo1').children;
var NeedToChild2= document.getElementById('NeedTo2').children;

var line1 = document.getElementById('line1');
var line2 = document.getElementById('line2');
var line3 = document.getElementById('line3');

var line11 = document.getElementById('line1-1');
var line22 = document.getElementById('line2-1');
var line33 = document.getElementById('line3-1');
var menuBool = false;

var box1 = document.getElementById('box1');
var Intro = document.querySelector('.intro');
var arrows = document.getElementById('arrows');
var headerDoc = document.getElementById('HeaderDoc');

var itemsListServices = document.getElementById('serviceItems');
var headerServices = document.getElementById('services-header');

var tl = new TimelineMax();

function openAndCloseNavBar(){
	if (menuBool == false){
		menuBool = true;
		navBar.style.right = "0%";

		button.style.position = "fixed";
		button.style.top = "20px";
		button.style.right = "10%";

		button2.style.position = "fixed";
		button2.style.top = "20px";
		button2.style.right = "10%";

		line1.style.transform = "rotateZ(45deg)";
		line2.style.opacity = "0";
		line3.style.transform = "rotateZ(-45deg)";

		line11.style.opacity = "0";
		line22.style.opacity = "0";
		line33.style.opacity = "0";

		line1.style.top = "0px";
		line3.style.top = "0px";
	}else{
		menuBool = false;
		navBar.style.right = "-100%";

		button.style.position = "relative";
		button.style.top = "0px";
		button.style.right = "0px";

		button2.style.position = "relative";
		button2.style.top = "0px";
		button2.style.right = "0px";

		line1.style.transform = "rotateZ(0deg)";
		line2.style.opacity = "1";
		line3.style.transform = "rotateZ(0deg)";

		line11.style.opacity = "1";
		line22.style.opacity = "1";
		line33.style.opacity = "1";

		line1.style.top = "-5px";
		line3.style.top = "15px";
	}
}

function intro(){
	tl.fromTo(Intro, 2, {opacity: "0"}, {opacity: "1"}),
	tl.fromTo(box1, 2, {opacity: "0"}, {opacity: "1"}, "-=1"),
	tl.fromTo(arrows, 2, {opacity: "0"}, {opacity: "1"}, "-=2"),
	tl.fromTo(headerDoc, 3, {opacity: "0"}, {opacity: "1"}, "-=2"),
	tl.fromTo(headerDoc, 2, {top: "-100"}, {top: "0"}, "-=3");
}

window.onload = intro();

addEventListener("scroll", () => {
	if (window.innerWidth < 450)
	{
		if (window.scrollY >= 45){
			aboutBox.style.opacity = "1";
			aboutHeader.style.opacity = "1";
			navFixed.style.opacity = "1";
			navFixed.style.zIndex = "2";
		}
		else{
			navFixed.style.opacity = "0";
			navFixed.style.zIndex = "0";
		}

		if (window.scrollY >= 300){
			NeedTo1.style.opacity = "1";
			NeedToChild1[0].style.opacity = "1";
		}

		if (window.scrollY >= 500){
			headerServices.style.opacity = "1";
			itemsListServices.style.opacity = "1";
		}

		if (window.scrollY >= 2500){
			NeedTo2.style.opacity = "1";
			NeedToChild2[0].style.opacity = "1";
		}
	}else{
		if (window.scrollY >= 300){
			aboutBox.style.opacity = "1";
			aboutHeader.style.opacity = "1";
			navFixed.style.opacity = "1";
			navFixed.style.zIndex = "2";
		}
		else{
			navFixed.style.opacity = "0";
			navFixed.style.zIndex = "0";
		}

		if (window.scrollY >= 600){
			NeedTo1.style.opacity = "1";
			NeedToChild1[0].style.opacity = "1";
		}

		if (window.scrollY >= 1000){
			headerServices.style.opacity = "1";
			itemsListServices.style.opacity = "1";
		}

		if (window.scrollY >= 1600){
			NeedTo2.style.opacity = "1";
			NeedToChild2[0].style.opacity = "1";
		}
	}
});

window.onbeforeunload = function () {
	window.scrollTo(0,0);
}