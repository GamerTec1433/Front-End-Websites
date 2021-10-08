var inputSearch = document.querySelector('nav input');

inputSearch.addEventListener('keyup', (e) => {
    if (e.keyCode === 13) {
        SetSearchSession(inputSearch.value);
        window.location.replace('searchitems.html');
    }
});

function SetSearchSession(value)
{
    sessionStorage.setItem('search', value);
    console.log(value);
}