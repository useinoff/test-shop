var products = [];
var random = null;

var generateProductCard = function(element) {
    let block = document.createElement("div");
    block.classList.add("col-md-4");

    let panel = document.createElement("div");
    panel.classList.add("panel", "panel-default");

    let panelhead = document.createElement("div");
    panelhead.classList.add("panel-heading");
    let textpanelhead = document.createTextNode(element.name);
    panelhead.appendChild(textpanelhead);

    let image = document.createElement('img');
    image.src = element.image;
    image.style.width = '100%';

    let price = document.createElement("span");
    price.classList.add("label", "label-success");
    let pricetext = document.createTextNode(element.price);
    price.appendChild(pricetext);


    let panelbody = document.createElement("div");
    panelbody.classList.add("panel-body");
    panelbody.appendChild(image);
    panelbody.appendChild(price);

    panel.appendChild(panelhead);
    panel.appendChild(panelbody);

    block.appendChild(panel);
    return block;
}

var addProductToPage = function(product){
    let list = document.getElementById("productList");
    list.appendChild(product);
}

var addRandom = function(product){
    let list = document.getElementById("randomBlock");
    list.appendChild(product);
}

var init = function() {
    fetch('http://localhost:8000/product')
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            products = data;
            products.forEach(element => addProductToPage(generateProductCard(element)));
        });

    fetch('http://localhost:8000/random')
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            products = data;
            products.forEach(element => addRandom(generateProductCard(element)));
        })
};

init();



