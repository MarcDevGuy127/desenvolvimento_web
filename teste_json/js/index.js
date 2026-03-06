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
    document.getElementById("result").innerHTML = json;

    console.log(json)
}