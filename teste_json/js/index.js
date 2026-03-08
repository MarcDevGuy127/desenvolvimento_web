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
const URL = 'https://dummyjson.com/products';

// async/await shows the results just when it is loaded.
// test it using
async function callApi() {
    const answer = await fetch(URL);
    console.log(answer);
}

callApi();