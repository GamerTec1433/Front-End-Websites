const mainContent = document.querySelector('.main');
var searchInput = sessionStorage.getItem('search');

if (searchInput === null)
{
    window.close();
}

var currentPageIndex = 1;
var canLoad = true;

LoadData(currentPageIndex++);

var data;
function LoadData (indexPage){
    (async () => {
     canLoad = false;
     let api_url = `https://api.rawg.io/api/games?page=${indexPage}&search=${searchInput}&key=${key}`;
     data = await getData(api_url);
     console.log(data);
     for (var i = 0; i < data.results.length; i++)
     {
         let item = new Item(
             data.results[i].id,
             data.results[i].name,
             data.results[i].background_image,
             data.results[i].released,
             data.results[i].genres
         );
         
         item.ReturnItemHTML();
         
     }
     canLoad = true;
 })(); 
 }

 window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
        if (canLoad)
            LoadData(currentPageIndex++);
    }
};