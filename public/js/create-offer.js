const required = document.querySelectorAll('[required]');

prepare();

function prepare() {
    menuButtons['create-offer'].classList.add('active');
    document.querySelector('.search-bar').style.display = 'none';
    document.querySelector('.left').style.display = 'none';
    //console.log(required);
    required.forEach(r => r.removeAttribute('required'));
}