const required = document.querySelectorAll('[required]');
const form = document.querySelector('form');

const inputs = {
    'img': form.querySelector('#upload-image'),
    'title': form.querySelector('#title'),
    'desc': form.querySelector('#desc'),
    'price': form.querySelector('#price'),
    'quantity': form.querySelector('#quantity'),
    'adv-courier': form.querySelector('#adv-courier-input'),
    'adv-inpost': form.querySelector('#adv-inpost-input'),
    'adv-in-person': form.querySelector('#adv-in-person-input'),
    'cod-courier': form.querySelector('#cod-courier-input'),
    'cod-in-person': form.querySelector('#cod-in-person-input'),
    'voivodeship': form.querySelector('#voivodeship'),
    'locality': form.querySelector('#locality'),
    'postcode': form.querySelector('#postcode'),
    'street': form.querySelector('#street'),
    'housenum': form.querySelector('#housenum'),
    'flatnum': form.querySelector('#flatnum')
};

prepare();

console.log(inputs);

function prepare() {
    //menuButtons['create-offer'].classList.add('active');
    document.querySelector('.search-bar').style.display = 'none';
    document.querySelector('.left').style.display = 'none';
    document.querySelector('header').style.flexDirection = 'row-reverse';
    //console.log(required);
    required.forEach(r => {
        if(!r.classList.contains('required')) r.classList.add('required');
        r.removeAttribute('required')});
    updateAddressRequirement();
}

function validateForm()
{
    let valid = true;
    console.log('Validating');
    document.querySelectorAll('.required').forEach(x => {
        valid = valid && markValidation(x, !isEmpty(x));
        if(isEmpty(x))
            x.value = null;
    });
    console.log(valid);
    return valid;
}

function updatePricesRequirement()
{
    console.log('price req update');
    const prices = [inputs['adv-in-person'], inputs['adv-courier'], inputs['adv-inpost'], inputs['cod-in-person'], inputs['cod-courier']];
    let required = true;
    prices.forEach(x => required = required && isEmpty(x));
    prices.forEach(x => {required ? x.classList.add('required') : x.classList.remove('required');
        markValidation(x, !required);
    });
}

function updateAddressRequirement()
{
    const required = !isEmpty(inputs['adv-in-person']) || !isEmpty(inputs['cod-in-person']);
    const address = [inputs['voivodeship'], inputs['locality'], inputs['postcode'], inputs['street'], inputs['housenum']];
    address.forEach(x => {
        required ? x.classList.add('required') : x.classList.remove('required');
        markValidation(x, !required);
    });
    /*inputs['voivodeship'].classList.add('required');
    inputs['locality'].classList.add('required');
    inputs['postcode'].classList.add('required');
    inputs['street'].classList.add('required');
    inputs['housenum'].classList.add('required');*/
}

inputs['adv-in-person'].addEventListener('keyup', updateAddressRequirement);
inputs['cod-in-person'].addEventListener('keyup', updateAddressRequirement);

inputs['adv-in-person'].addEventListener('keyup', updatePricesRequirement);
inputs['adv-inpost'].addEventListener('keyup', updatePricesRequirement);
inputs['adv-courier'].addEventListener('keyup', updatePricesRequirement);
inputs['cod-in-person'].addEventListener('keyup', updatePricesRequirement);
inputs['cod-courier'].addEventListener('keyup', updatePricesRequirement);