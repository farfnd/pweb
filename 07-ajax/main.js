var XMLHttpRequestObject = false;

if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHttp");
}

function getText() {
    if (XMLHttpRequestObject) {
        const obj = document.getElementById("text-container");
        XMLHttpRequestObject.open("GET", "text.html");
        XMLHttpRequestObject.onreadystatechange = () => {
            if (XMLHttpRequestObject.readyState === 1) {
                obj.innerHTML = `Loading...`;
            }
            if (XMLHttpRequestObject.readyState === 4) {
                if (XMLHttpRequestObject.status === 200) {
                    obj.innerHTML = XMLHttpRequestObject.responseText;
                } else {
                    obj.innerHTML = XMLHttpRequestObject.statusText;
                }
            }
        };
        XMLHttpRequestObject.send(null);
    }
}

function getFakultas() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const myObj = JSON.parse(this.responseText);
        let html = `<option label="Pilih fakultas" hidden></option>`;
        let idx = 0;
        for (let x of Object.keys(myObj)) {
            html += `<option value='${idx}'>${x}</option>`;
            idx++;
        }
        document.getElementById("fakultas").innerHTML = html;
        document.getElementById("departemen").innerHTML = `<option label="Pilih fakultas terlebih dahulu" hidden></option>`
    };
    xhttp.open("GET", "fakultas.json", true);
    xhttp.send();
}

function getDept() {
    let fakultas = document.getElementById('fakultas').value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const myObj = JSON.parse(this.responseText);
        let html = `<option label="Pilih departemen" hidden></option>`;
        for (let x of Object.values(myObj)[fakultas]) {
            html += `<option>${x}</option>`;
        }
        document.getElementById("departemen").innerHTML = html;
    };
    xhttp.open("GET", "fakultas.json", true);
    xhttp.send();
}