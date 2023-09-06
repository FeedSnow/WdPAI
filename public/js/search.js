const search = document.querySelector('input[placeholder="Szukaj ofert"]');
const offersContainer = document.querySelector('.offers');
const button = document.querySelector('.fa-pagelines').parentElement;
const emptyPage = document.querySelector('.empty-page');

button.classList.add('active');

function createOffer(offer) {
    const template = document.querySelector('#offer-template');

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector("div");
    div.id = `offer-${offer.offer_id}`;
    const image = clone.querySelector("img");
    image.src = `public/uploads/${offer.offer_image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = offer.offer_title;
    const description = clone.querySelector("p");
    description.innerHTML = offer.offer_description;
    const price = clone.querySelector("h3");
    price.innerHTML = `${offer.offer_price/100}zł`;

    offersContainer.appendChild(clone);
}

function loadOffers(offers) {
    offers.forEach(offer => {
        console.log(offer);
        createOffer(offer);
    });
    console.log(`count: ${offers.length}`);
    setEmptyPageInfoActive(offers.length === 0);
}

function setEmptyPageInfoActive(active) {
    console.log(`active: ${active}`);
    if(active)
        emptyPage.style.display = 'flex';
    else
        emptyPage.style.display = 'none';
}

search.addEventListener('keyup', function(event) {
    if(event.key !== "Enter")
        return;

    event.preventDefault();

    setEmptyPageInfoActive(false);

    const data = {search: this.value};

    fetch('/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function(response) {
        return response.json();
    }).then(function(offers) {
        offersContainer.innerHTML = "";
        loadOffers(offers);
    })
});