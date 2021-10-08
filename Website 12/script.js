var add = document.querySelector('#enter');
var rem = document.querySelector('#remove');
var input = document.querySelector('input');

var nCom = document.querySelector('.nCom');
var com = document.querySelector('.com');
var j = 0, k = 0;

// CLASS OF OOB
class Task {
	constructor(name){
		this.createDiv(name);
	}

	createDiv(name){
		localStorage.setItem("notComp" + j, name);
		j++;
		var div = document.createElement("div");

		var p = document.createElement("p");
		p.innerHTML = name;

		var iconsdiv = document.createElement("div");
		var checkerDiv = document.createElement("div");
		var delDiv = document.createElement("div");

		var icons = ["<i class='fas fa-check check icon'></i>",
					"<i class='fas fa-trash-alt del icon'></i>"];
		nCom.appendChild(div);
		div.classList.add("item");
		div.appendChild(p);
		div.appendChild(iconsdiv);

		iconsdiv.classList.add("icons");
		iconsdiv.appendChild(checkerDiv);
		iconsdiv.appendChild(delDiv);

		checkerDiv.classList.add("check");
		delDiv.classList.add("del");

		checkerDiv.innerHTML = icons[0];
		delDiv.innerHTML = icons[1];

		checkerDiv.addEventListener('click', () => {
		 	new completedTask(name);
		});

		delDiv.addEventListener('click', () => {
			for (var i = 1; i <= j; i++) {
				if(nCom.children[i] == div)
				{
					localStorage.removeItem("notComp" + (i-1));
					div.remove();
				}
			}
		});
	}
}

class completedTask{
	constructor(name){
		this.createDiv(name);
	}

	createDiv(name){
		localStorage.setItem("Comp" + k, name);
		k++;
		var div = document.createElement("div");

		var p = document.createElement("p");
		p.innerHTML = name;

		var iconsdiv = document.createElement("div");
		var delDiv = document.createElement("div");

		var icons = "<i class='fas fa-trash-alt del icon'></i>";

		com.appendChild(div);
		div.classList.add("item");
		div.appendChild(p);
		div.appendChild(iconsdiv);

		iconsdiv.classList.add("icons");
		iconsdiv.appendChild(delDiv);

		delDiv.classList.add("del");
		delDiv.innerHTML = icons;

		delDiv.addEventListener('click', () => {
			console.log("as");
			for (var i = 1; i <= k; i++) {
				console.log(com.children[i]);
				if(com.children[i] == div)
				{
					localStorage.removeItem("Comp" + (i-1));
					div.remove();
				}
			}
		});
	}
}

var dataNotCompleted = [];

// ARRAY OF DATA
var numOfNotCom = 0;
while(localStorage.getItem("notComp" + numOfNotCom) != null)
{
	dataNotCompleted[numOfNotCom] = localStorage.getItem("notComp" + numOfNotCom);
	numOfNotCom++;
}

for(var i = 0; i < 100; i++)
{
	if(dataNotCompleted[i] != null)
	{
		new Task(dataNotCompleted[i]);
	}
}

var dataCompleted = [];

var numOfCom = 0;
while(localStorage.getItem("Comp" + numOfCom) != null)
{
	dataCompleted[numOfCom] = localStorage.getItem("Comp" + numOfCom);
	numOfCom++;
}

for(var i = 0; i < 100; i++)
{
	if(dataCompleted[i] != null)
	{
		new completedTask(dataCompleted[i]);
	}
}

add.addEventListener('click', () => {
	if(input.value != '' && nCom.children.length < 100)
	{
		new Task(input.value);
		input.value = '';
	}
});

rem.addEventListener('click', () => {
	input.value = '';
});
