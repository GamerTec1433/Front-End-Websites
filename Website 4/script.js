var nav = document.querySelector(".navPar");
var navCont = document.querySelector(".navPar").children;
var intro = document.querySelector(".intro");
var services = document.querySelector(".services");
var mid = document.querySelector(".mid");
var people = document.querySelector(".people");

var tl = new TimelineMax();

function animationStart(){
	tl.fromTo(nav, 1, {y: "-100%"}, {y: "0%"}, "+=0.5"),
	tl.fromTo(navCont, 1, {opacity: "0"}, {opacity: "1"}, "-=0.5"),
	tl.fromTo(intro, 2, {opacity: "0"}, {opacity: "1"}, "-=1.5"),
	tl.fromTo(services, 1, {opacity: "0"}, {opacity: "1"}, "-=1.5"),
	tl.fromTo(mid, 1, {opacity: "0"}, {opacity: "1"}, "-=1.5"),
	tl.fromTo(people, 1, {opacity: "0"}, {opacity: "1"}, "-=1.5");
}

window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}

window.onload = animationStart();