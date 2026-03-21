function sendInfo() {
    const name = document.getElementById("name").value;
    const password = document.getElementById("password").value;

    // creating object to be converted in JSON
    // attribute: value
    const object = {
        name: name,
        password: password
    }

    // converting object in json
    const json = JSON.stringify(object);

    // showing results
    document.getElementById("jsonResult").innerHTML = json;

    // converting json in object

    const obj = JSON.parse(json);

    // showing results
    document.getElementById("objectResult").innerHTML = object.name + ", " + object.password;
}
const PRODUCTS_URL = 'https://dummyjson.com/products';

// async/await shows the results just when it is loaded.
// fetch(url, method: GET/POST/etc)
async function callApi() {
    const response = await fetch(PRODUCTS_URL); // the first await load the Header
    
    if (response.status === 200) { // if response status 200
        const data = await response.json(); // the second await load the Body
        
        //const apiList = document.getElementById("apiListResult");
        
        console.log(data);
        document.getElementById("apiResult").innerHTML =
           `ID: ${data.products[0].id}
           <br> Name: ${data.products[0].title}
           <br> Body: ${data.products[0].description}`;
    }
}

callApi();

async function fetchPokedex() {
   
    try {
        const pokemonName = document.getElementById("pokemonName").value.toLowerCase();
        const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonName}`);

        if (!response.ok) {
            throw new Error("Could not fetch resource");
        }

        const data = await response.json();
        const pokemonSprite = data.sprites.front_default;
        // const pokemonTitle = data.name.front_default;
        const imgElement = document.getElementById("pokemonSprite");
        // const cardElement = document.getElementById("pokemonTitle");

        // cardElement.src = pokemonTitle;
        // cardElement.style.background("yellow");

        imgElement.src = pokemonSprite;
        imgElement.style.display = "block";
    } catch (error) {
        console.error(error);
    }
}