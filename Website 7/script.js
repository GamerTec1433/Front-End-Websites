var sideBtn = document.querySelector('.sidebarBtn');
var sidBar = document.querySelector('.sidebar');
var sidItem = document.querySelectorAll('.item');
var sidItemFlex = document.querySelectorAll('.itemflex');
var sideLogo = document.querySelector('.logoSide');

var menuOpen = false;

function funMenu(){
	if (window.innerWidth >= 1300)
	{
		if (menuOpen == false){
			for (var i = 0; i <= sidItem.length - 1; i++) {
				sidItem[i].style.gridColumnStart = "2";
				sidItem[i].style.gridColumnEnd = "3";
				sidItemFlex[i].classList.add("styleFlex");
			}
			sideLogo.style.gridColumnStart = "2";
			sideBtn.style.gridColumnStart = "3";
			sideBtn.style.gridColumnEnd = "4";
			sidBar.style.width = "250px";
			menuOpen = true;
		}else if(menuOpen == true){
			for (var i = 0; i <= sidItem.length - 1; i++) {
				sidItem[i].style.gridColumnStart = "1";
				sidItem[i].style.gridColumnEnd = "2";
				 sidItemFlex[i].classList.remove("styleFlex");
			}
			sideLogo.style.gridColumnStart = "1";
			sideBtn.style.gridColumnStart = "2";
			sideBtn.style.gridColumnEnd = "3";
			sidBar.style.width = "120px";
			menuOpen = false;
		}
	}else if (window.innerWidth <= 1300){
		if (menuOpen == false){
			for (var i = 0; i <= sidItem.length - 1; i++) {
				sidItem[i].style.gridColumnStart = "2";
				sidItem[i].style.gridColumnEnd = "3";
				sidItemFlex[i].classList.remove("styleFlex");
			}
			sideLogo.style.gridColumnStart = "2";
			sideBtn.style.gridColumnStart = "3";
			sideBtn.style.gridColumnEnd = "4";
			sidBar.style.width = "250px";
			menuOpen = true;
		}else if(menuOpen == true){
			for (var i = 0; i <= sidItem.length - 1; i++) {
				sidItem[i].style.gridColumnStart = "1";
				sidItem[i].style.gridColumnEnd = "2";
			}
			sideLogo.style.gridColumnStart = "1";
			sideBtn.style.gridColumnStart = "2";
			sideBtn.style.gridColumnEnd = "3";
			sidBar.style.width = "120px";
			menuOpen = false;
		}
	}
	
}
