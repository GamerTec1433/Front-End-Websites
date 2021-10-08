const key = "f4e4e7cba62744aead52857b180815b6";

async function getData(url)
{
    const response = await fetch(url);
    const data = await response.json();
    //console.log(data);
    // console.log(data.results);
    // console.log(data.results.length);
    return data;
}

class Item{
    constructor(id, name, image_background, released, genres)
    {
        this.id = id;
        this.name = name;
        this.image_background = image_background;
        this.released = released;
        this.genres = genres;
    }

    ItemGeneras()
    {
        let genres = '';
        for (let i = 0; i < this.genres.length; i++)
        {
            genres += '<a href="#">';
            genres += this.genres[i].name;
            if (i != this.genres.length-1)
            {
                genres += ", ";
            }
            genres += '</a>'
        }
        return genres;
    }

    ReturnItemHTML()
    {
        let mainContent = document.querySelector('.main');
        let lengthOfItems = mainContent.childNodes.length;
        let item = '<div class="item-grid">' +
                '<div class="item">' +
                    `<img src="${this.image_background}" alt="">` +
                    '<div class="content">' +
                        `<a href="itempage.html" onclick="SetItemIdSession(${this.id})"><h1>${this.name}</h1></a>` +
                        '<div class="data">' +
                            `<p>Release Date:</p>` +
                            `<p>${this.released}</p>` +
                            '<div class="line"></div>' +
                        '</div>' +
                        '<div class="data">' +
                            '<p>Genres:</p>' +
                            '<div>' +
                            `${this.ItemGeneras()}` +
                            '</div>' +
                            '<div class="line"></div>' +
                        '</div>' +
                        '<div class="data">' +
                            `<button class="hide-btn" onclick="OnHideItem(${lengthOfItems})">Hide ${this.name} Game</button>` +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';

        mainContent.innerHTML += item;
        lengthOfItems++;
        let currentItem = mainContent.childNodes[lengthOfItems-1];
        // console.log(mainContent.childNodes);
        let hideBtn = currentItem.querySelector('.hide-btn');
    }
}

function OnHideItem(itemIndex)
{
    let mainContent = document.querySelector('.main');
    let currentItem = mainContent.childNodes[itemIndex];
    currentItem.classList.add('unactive');
    console.log(currentItem);
}

function SetItemIdSession(id)
{
    sessionStorage.setItem('game_item', id);
    console.log(id);
}