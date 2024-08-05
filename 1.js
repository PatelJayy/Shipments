let elements = document.querySelector(".elements");
let dataaa = document.querySelector(".dataaa");
let searchbar = document.getElementById("searchbar");
let dataStore = [];

getdata();

function getdata() {
    fetch(
    'https://run.mocky.io/v3/69f60a58-3a36-48c5-a9cf-b100b015950c'
  )
    .then((response) => {
      const data = response.json();
      return data;
    })
    .then((data) => {
        dataStore = data.data;
        dataaa.innerHTML = getHTML(data.data);
    });
}

function getHTML(data){
    return data.map(({slug, symbol, metrics}) => generateHTML(slug, symbol, metrics)).join('');
}

function generateHTML(name, symbol, {market_data: { price_usd }}){
    return `<div class="pieceofdata"><h1 class= "symbol"> ${symbol}</h1><h1 class= "name"> ${name}</h1><h1 class= "price"> $${+price_usd.toFixed(2)}</h1>
        </div>`;
}

function noResultHTML(){
    return `<div class="pieceofdata"><h1 class= "symbol"> </h1><h1 class= "name"></h1> <h1 class="name">No Results Found</h1> <h1 class= "price"></h1>
      </div>`;
}

searchbar.addEventListener('keyup', function(e){
    const currentword = e.target.value;
    const filteredData= dataStore.filter(o => o.slug.includes(currentword));
    dataaa.innerHTML = filteredData.length ? getHTML(filteredData) : noResultHTML();
});