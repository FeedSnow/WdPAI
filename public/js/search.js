let pageName;
prepare();

const searchBar = document.querySelector('input#search');
const tilesContainer = document.querySelector(`.${pageName}`);
const emptyPage = document.querySelector('.empty-page');
const userId = document.querySelector('.session-data').querySelector('.userId').innerHTML;
const userRoleValue = document.querySelector('.session-data').querySelector('.userRoleValue').innerHTML;
console.log(`User ID: ${userId}`);
console.log(`User Role: ${userRoleValue}`);
search();

function prepare()
{
    const words = document.documentURI.split('/');
    pageName = words[words.length-1];
    menuButtons[pageName].classList.add('active');
}

function createOffer(offer) {
    const template = document.querySelector('#offer-template');

    const clone = template.content.cloneNode(true);

    const deleteButton = clone.querySelector("#delete-offer");
    if(userRoleValue >= 2 || offer.offer_author_id == userId)
        deleteButton.style.display = 'block';
    else
        deleteButton.style.display = 'none';

    const div = clone.querySelector("div");
    div.id = offer.offer_id;
    const image = clone.querySelector("img");
    image.src = `public/uploads/${offer.offer_image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = offer.offer_title;
    const description = clone.querySelector("p.desc");
    description.innerHTML = offer.offer_description;
    const email = clone.querySelector("p.email");
    email.innerHTML = offer.user_email;
    const price = clone.querySelector("h3");
    price.innerHTML = offer.offer_price > 0 ? `${offer.offer_price/100}zł` : 'Za darmo';

    tilesContainer.appendChild(clone);
}

function createContact(contact) {
    const template = document.querySelector('#contact-template');

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector("div");
    div.id = `contact-${contact.id}`;
    const image = clone.querySelector("img");
    image.src = `public/uploads/${contact.image}`;
    const name = clone.querySelector("h1");
    name.innerHTML = `${contact.name} ${contact.surname}`;
    const num = clone.querySelector("#number");
    num.innerHTML = `${contact.phone.toString().substring(0, 3)}-${contact.phone.toString().substring(3, 6)}-${contact.phone.toString().substring(6)}`;
    const email = clone.querySelector("#email");
    email.innerHTML = contact.email;
    const locality = clone.querySelector("#locality");
    locality.innerHTML = contact.locality;

    tilesContainer.appendChild(clone);
}

function loadTiles(tiles) {
    tiles.forEach(tile => {
        console.log(tile);
        switch (pageName)
        {
            case 'offers':
                createOffer(tile);
                break;
            case 'contacts':
                createContact(tile);
                break;
        }
    });

    setEmptyPageInfoActive(tiles.length === 0);
}

function setEmptyPageInfoActive(active) {
    //console.log(`active: ${active}`);
    if(active)
        emptyPage.style.display = 'flex';
    else
        emptyPage.style.display = 'none';
}

function search()
{
    setEmptyPageInfoActive(false);

    const data = {search: searchBar.value};

    fetch(`/search-${pageName}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function(response) {
        return response.json();
    }).then(function(tiles) {
        tilesContainer.innerHTML = "";
        loadTiles(tiles);
    })
}

function deleteOffer(button)
{
    button.style.display =  'none';
    const data = {id: button.parentElement.parentElement.parentElement.parentElement.id};
    let succeeded;
    fetch('/delete-offer', {
        method: 'POST',
        body: JSON.stringify(data)
    }).then(function(response) {
        return response.json();
    }).then(x => succeeded = x);
    search();
}

function addContact(email)
{
    console.log(email.innerHTML);
    const data = {email: email.innerHTML };
    console.log(JSON.stringify(data));
    let succeeded;
    fetch('/add-contact', {
        method: 'POST',
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(x => succeeded = x);
    console.log(`succedeed: ${succeeded}`);
}

searchBar.addEventListener('keyup', function(event) {
    if(event.key !== "Enter")
        return;

    event.preventDefault();

    search();
});