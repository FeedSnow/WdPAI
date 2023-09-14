const form = document.querySelector("form");
const nameInput = form.querySelector('input[name="name"]');
const surnameInput = form.querySelector('input[name="surname"]');
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = passwordInput.nextElementSibling;
const register = form.classList.contains('register');
prepare();

function prepare()
{
    emailInput.addEventListener('keyup', validateEmail);
    if(!register) {
        passwordInput.addEventListener('keyup', _ => markValidation(passwordInput, true));
        return;
    }
    nameInput.addEventListener('keyup', _ => markValidation(nameInput, true));
    surnameInput.addEventListener('keyup', _ => markValidation(surnameInput, true));
    passwordInput.addEventListener('keyup', validatePassword);
    passwordInput.addEventListener('keyup', validateConfirmedPassword);
    confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);
}

function isEmail(email)
{
    return /\S+@\S+\.\S+/.test(email);
}

function isPasswordSafe(password)
{
    const regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,30}$/;
    return regex.test(password);
}

function arePasswordsEqual(password, confirmedPassword)
{
    return password === confirmedPassword;
}

function validateEmail() {
    if(isEmpty(emailInput))
        return;
    //setTimeout(function() {
        markValidation(emailInput, isEmail(emailInput.value))
    //}, 1000)
}

function validatePassword() {
    //setTimeout(function () {
    if(isEmpty(passwordInput))
        return;
    markValidation(passwordInput, isPasswordSafe(passwordInput.value))
    //}, 100)
}

function validateConfirmedPassword() {
    //setTimeout(function() {
        if(isEmpty(confirmedPasswordInput))
            return;

        const condition = arePasswordsEqual(
            passwordInput.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput, condition)
    //}, 100)
    //TODO po zmianie hasła powinien się zmieniać automatycznie status pola confirm-password
}

function validateForm() {
    let valid = markValidation(emailInput, !isEmpty(emailInput));
    valid = markValidation(passwordInput, !isEmpty(passwordInput)) && valid;
    if(register) {
        valid = markValidation(nameInput, !isEmpty(nameInput)) && valid;
        valid = markValidation(surnameInput, !isEmpty(surnameInput)) && valid;
        valid = markValidation(confirmedPasswordInput, !isEmpty(confirmedPasswordInput)) && valid;
    }
    /*if(markValidation(nameInput, !isEmpty(nameInput))
        || markValidation(lastnameInput, !isEmpty(lastnameInput))
        || markValidation(emailInput, !isEmpty(emailInput))
        || markValidation(passwordInput, !isEmpty(passwordInput))
        || markValidation(confirmedPasswordInput, !isEmpty(confirmedPasswordInput))
        //|| form.querySelector('input[type="checkbox"]')
        ) {*/
    if(!valid) {
        console.log('empty');
        return false;
    }

    valid = markValidation(emailInput, isEmail(emailInput.value));
    if(register) {
        valid = markValidation(passwordInput, isPasswordSafe(passwordInput.value)) && valid;
        valid = markValidation(confirmedPasswordInput, arePasswordsEqual(passwordInput.value, confirmedPasswordInput.value)) && valid;
    }

    /*if(!isEmail(emailInput.value)
        || !isPasswordSafe(passwordInput.value)
        || !arePasswordsEqual(passwordInput.value, confirmedPasswordInput.value)) {*/
    if(!valid) {
        console.log('bad value');
        return false;
    }

    console.log('true');
    return true;
}


