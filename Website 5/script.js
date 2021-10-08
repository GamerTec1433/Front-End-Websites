var galaryItems = document.getElementById('galary').children;
var circlesItems = document.getElementById('contents-num').children;
var	contentsItems = document.getElementById('contents').children;
var time = 2000;
var i = 0;

var sec1 = document.getElementById('sec1');
var sec1Head = document.getElementById('sec1-header');
var sec1Words = document.querySelector(".warp-btn");

var mainGalary = document.getElementById('galary');
var galary = document.getElementById('galary').children;
var contentHead = document.getElementById('content-head');

var circle = document.getElementById('contents-num');
var	content = document.getElementById('contents');
var	btnBot = document.getElementById('btn-bot');

var	arrows = document.getElementById('arrows');
var loadLine = document.getElementById('lineLoad');

var tl = new TimelineMax();

function changeImg(){
	if(i < 0){
		i = 0;
	}
	if(i < galaryItems.length)
	{
		if(i == 0){
			galaryItems[galaryItems.length - 1].style.zIndex = "1";
			galaryItems[galaryItems.length - 1].style.display = "none";
		}
		galaryItems[i].style.display = "block";
		contentsItems[i].style.display = "block";
		circlesItems[i].style.background = "rgb(242,206,97)";
		circlesItems[i].style.color = "black";
		i++;
		if(i >= 2){
			if(i >= 3){
				galaryItems[i - 3].style.display = "none";
			}
			galaryItems[galaryItems.length - 1].style.zIndex = "2";
			contentsItems[i - 2].style.display = "none";
			circlesItems[i - 2].style.backgroundColor = "transparent";
			circlesItems[i - 2].style.color = "rgb(242,206,97)";
		}
	}else{
		i = 0;
		galaryItems[galaryItems.length - 1].style.zIndex = "1";
		contentsItems[galaryItems.length - 1].style.display = "none";
		circlesItems[galaryItems.length - 1].style.backgroundColor = "transparent";
		circlesItems[galaryItems.length - 1].style.color = "rgb(242,206,97)";
		galaryItems[galaryItems.length - 2].style.display = "none";
		galaryItems[i].style.display = "block";
		circlesItems[i].style.background = "rgb(242,206,97)";
		contentsItems[i].style.display = "block";
		circlesItems[i].style.color = "black";
	}

	setTimeout("changeImg()", time);
}


function selectImg(j){
	i = j;
	galaryItems[i].style.display = "block";
	circlesItems[i].style.background = "rgb(242,206,97)";
	contentsItems[i].style.display = "block";
	circlesItems[i].style.color = "black";
	for (var k = 0; k < galaryItems.length; k++){
		if(i != k)
		{
			galaryItems[k].style.display = "none";
			circlesItems[k].style.background = "transparent";
			circlesItems[k].style.color = "rgb(242,206,97)";
			contentsItems[k].style.display = "none";
		}
		else
		{
			continue;
		}
	}
}

function backImg(){

	if(i <= 0){
		i = galaryItems.length - 1;
	}else{
		i--;
	}
	galaryItems[i].style.display = "block";
	circlesItems[i].style.background = "rgb(242,206,97)";
	contentsItems[i].style.display = "block";
	circlesItems[i].style.color = "black";
	for (var k = 0; k < galaryItems.length; k++){
		if(i != k)
		{
			galaryItems[k].style.display = "none";
			circlesItems[k].style.background = "transparent";
			circlesItems[k].style.color = "rgb(242,206,97)";
			contentsItems[k].style.display = "none";
		}
		else
		{
			continue;
		}
	}
}

function nextImg(){

	if(i >= galaryItems.length - 1){
		i = 0;
	}else{
		i++;
	}
	galaryItems[i].style.display = "block";
	circlesItems[i].style.background = "rgb(242,206,97)";
	contentsItems[i].style.display = "block";
	circlesItems[i].style.color = "black";
	for (var k = 0; k < galaryItems.length; k++){
		if(i != k)
		{
			galaryItems[k].style.display = "none";
			circlesItems[k].style.background = "transparent";
			circlesItems[k].style.color = "rgb(242,206,97)";
			contentsItems[k].style.display = "none";
		}
		else
		{
			continue;
		}
	}
}

changeImg();








function IntroAni(){
	tl.fromTo(sec1, 3, {opacity: "0"}, {opacity: "1"}),
	tl.fromTo(sec1Head, 1, {y: "-200%"}, {y: "0%"}, "-= 2.5"),
	tl.fromTo(sec1Words, 1, {y: "150%"}, {y: "0%"}, "-=2.5");
}

function TopAni(){
	tl.fromTo(sec1Head, 1, {y: "-200%"}, {y: "0%"}),
	tl.fromTo(sec1Words, 1, {y: "250%"}, {y: "0%"}, "-=1");
}

function BotAni(){
	tl.fromTo(mainGalary, 1, {x: "200%"}, {x: "0%"}),
	tl.fromTo(galary, 1, {x: "200%"}, {x: "0%"}, "-1"),
	tl.fromTo(loadLine, 1, {x: "200%"}, {x: "0%"}, "-=1"),
	tl.fromTo(contentHead, 3, {opacity: "0"}, {opacity: "1"}, "-=1"),
	tl.fromTo(arrows, 2, {opacity: "0"}, {opacity: "1"}, "-=2"),
	tl.fromTo(btnBot, 1, {y: "250%"}, {y: "0%"}, "-=2"),
	tl.fromTo(circle, 1, {x: "-250%"}, {x: "0%"}, "-=2"),
	tl.fromTo(content, 1, {x: "-250%"}, {x: "0%"}, "-=2");
}

IntroAni();
window.scrollTo(0, 0);