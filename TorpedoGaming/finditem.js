const id = sessionStorage.getItem('game_item');

if (id == null)
{
    window.close();
}

const api_url_item = `https://api.rawg.io/api/games/${id}?key=${key}`;
const api_url_screenshots = `https://api.rawg.io/api/games/${id}/screenshots?key=${key}`;


let backgroundImage = document.querySelector('.background-image');
let gameName = document.querySelector('.game-name');
let primaryScreenshotsSlider = document.querySelector('#primary-screenshots-slider .splide__list');
let screenshotsSlider = document.querySelector('#screenshots-slider .splide__list');
let aboutUs = document.querySelector('.about-us');
let platforms = document.querySelector('.platforms');
let genre = document.querySelector('.genre');
let developer = document.querySelector('.developer .splide__list');
let rating = document.querySelector('.rating h1');
let tags = document.querySelector('.tags');
let website = document.querySelector('.website');
let publisher = document.querySelector('#publishers-slider .splide__list');
let gamesSeriesSlider = document.querySelector('#games-series-slider .splide__list');

var data, dataScreenshots;
(async () => {
    data = await getData(api_url_item);
    dataScreenshots = await getData(api_url_screenshots);

    console.log(data);

    let main_background = `linear-gradient(rgba(31, 31, 31, .2), rgb(31, 31, 31)), linear-gradient(rgba(31, 31, 31, 0.8), rgba(31, 31, 31, .1)), url("${data['background_image']}")`;

    backgroundImage.style.backgroundImage = main_background;

    let images = dataScreenshots['results'];

    for (let i = 0; i < images.length; i++)
    {
        let urlImage = images[i].image;
        let htmlImage = `<li class="splide__slide"><img src="${urlImage}" alt="Error"></li>`;
    screenshotsSlider.innerHTML += htmlImage;
    primaryScreenshotsSlider.innerHTML += htmlImage;
    }

    var primarySlider = new Splide( '#primary-screenshots-slider', {
        type       : 'fade',
        pagination : false,
        arrows     : false
    }).mount();

    var secondarySlider = new Splide('#screenshots-slider', {
        fixedWidth: 300,
		rewind    : true,
		gap       : 10,
		pagination: false,
        focus      : 'center',
        height     : 150,
        cover      : true,
		isNavigation: true,
        breakpoints: {
            '1000': {
                fixedWidth: 200,
                height: 70
            },
            '800': {
                fixedWidth: 100
            }
        }
    }).mount();

    primarySlider.sync(secondarySlider).mount();

    gameName.innerHTML = data['name'];
    aboutUs.innerHTML = data['description'];


    let platformsData = data['platforms'];

    for (let i = 0; i < platformsData.length; i++)
    {
        let platform = platformsData[i].platform;
        let platformName = platform.name;
        let htmlPlatform = `<a href="#">${platformName}</a>`;
        platforms.innerHTML += htmlPlatform;
        if (i != platformsData.length - 1)
        {
            platforms.innerHTML += "<span>, </span>";
        }
    }

    let genresData = data['genres'];

    for (let i = 0; i < genresData.length; i++)
    {
        let genreName = genresData[i].name;
        let htmlGenre = `<a href="#">${genreName}</a>`;
        genre.innerHTML += htmlGenre;
        if (i != genresData.length - 1)
        {
            genre.innerHTML += "<span>, </span>";
        }
    }

    let developersData = data['developers'];
    console.log(developersData);
    for (let i = 0; i < developersData.length; i++)
    {
        let img = developersData[i].image_background;
        let name = developersData[i].name;
        let count = developersData[i].games_count;
        let htmlDev = `<li class="card splide__slide">
        <img src="${img}" alt="">
        <div class="content">
        <h1>Developer: ${name}</h1>
        <p>Games Made: ${count}</p>
        </div>
    </li>`;

    developer.innerHTML += htmlDev;
    }
    
    new Splide('#developers-slider', {
        perPage: 3,
        rewind: true,
        breakpoints: {
            '1300' : {
                perPage: 2
            },
            '1000': {
                perPage: 1
            }
        }
    }).mount();

    rating.innerHTML = data['rating'];

    let tagsData = data['tags'];

    for (let i = 0; i < tagsData.length; i++)
    {
        let tagName = tagsData[i].name;
        let htmlTag = `<a href="#">${tagName}</a>`;
        tags.innerHTML += htmlTag;
        if (i != tagsData.length - 1)
        {
            tags.innerHTML += "<span>, </span>";
        }
    }

    website.innerHTML += `<a href="${data['website']}">${data['website']}</a>`;

    let publisherData = data['publishers'];

    for (let i = 0; i < publisherData.length; i++)
    {
        let publisherImage = publisherData[i].image_background;
        let publisherName = publisherData[i].name;
        let htmlpublisher = `<li class="card splide__slide">
        <img src="${publisherImage}" alt="">
        <div class="content">
        <h1>Publisher: ${publisherName}</h1>
        </div>
    </li>`;
    publisher.innerHTML += htmlpublisher;
        if (i != publisherData.length - 1)
        {
            publisher.innerHTML += "<span>, </span>";
        }
    }

    new Splide('#publishers-slider', {
        perPage: 3,
        rewind: true,
        breakpoints: {
            '1300' : {
                perPage: 2
            },
            '1000': {
                perPage: 1
            }
        }
    }).mount();
})();

/*

                        <li class="card splide__slide">
                            <img src="imgs/img (1).jpg" alt="">
                            <h1>Name: Developer</h1>
                            <p>Games Made: 999</p>
                        </li>
                        <li class="card splide__slide">
                            <img src="imgs/img (2).jpg" alt="">
                            <h1>Name: Developer</h1>
                            <p>Games Made: 999</p>
                        </li>
                        <li class="card splide__slide">
                            <img src="imgs/img (3).jpg" alt="">
                            <h1>Name: Developer</h1>
                            <p>Games Made: 999</p>
                        </li>
*/