var menu = document.getElementById('navMob');

var show = false;

function ShowHideMenu()
{
	if(show == false)
	{
		show = true;
		menu.style.transform = "translateX(0%)";
	}else{
		show = false;
		menu.style.transform = "translateX(100%)";
	}
}

var loading = document.getElementById('load');
var intro = document.getElementById('introP');
var about = document.getElementById('aboutP');
var services = document.getElementById('servP');
var contact = document.getElementById('contP')

window.addEventListener('scroll', function()
	{
		if(window.innerHeight < 400)
		{
			if(window.scrollY > 300)
			{
				about.style.opacity = "1";
			}
			if(window.scrollY > 1400)
			{
				services.style.opacity = "1";
			}
			if(window.scrollY > 2250)
			{
				contact.style.opacity = "1";
			}
		}
		else if(window.innerHeight < 800)
		{
			if(window.scrollY > 300)
			{
				about.style.opacity = "1";
			}
			if(window.scrollY > 2000)
			{
				services.style.opacity = "1";
			}
			if(window.scrollY > 3650)
			{
				contact.style.opacity = "1";
			}
		}
		else if(window.innerHeight < 1200)
		{
			if(window.scrollY > 0)
			{
				about.style.opacity = "1";
			}
			if(window.scrollY > 2800)
			{
				services.style.opacity = "1";
			}
			if(window.scrollY > 4400)
			{
				contact.style.opacity = "1";
			}
		}

		if(window.innerWidth > 800)
		{
			if(window.scrollY > 0)
			{
				about.style.opacity = "1";
			}
			if(window.scrollY > 900)
			{
				services.style.opacity = "1";
			}
			if(window.scrollY > 1800)
			{
				contact.style.opacity = "1";
			}
		}
	});

function introMove()
{
	intro.style.transform = "translateX(0%)";
}

function loadDisplay()
{
	loading.style.display = "none";
}

function load()
{
	loading.style.opacity = "0";
	introMove();
	setInterval(loadDisplay, 1000)
}

window.onload = load;
