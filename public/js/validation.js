const form = document.querySelector("form");
const nameInput = form.querySelector('input[name="firstname"]');
const lastnameInput = form.querySelector('input[name="lastname"]');
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = passwordInput.nextElementSibling;

function isEmpty(input)
{
    const empty = (input.value === "");
    markValidation(input, empty);
    return empty;
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

function markValidation(element, condition)
{
    !condition ? element.classList.add('invalid') : element.classList.remove('invalid');
    return condition;
    //element.validity = condition;
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
    let valid = markValidation(nameInput, !isEmpty(nameInput));
    valid = markValidation(lastnameInput, !isEmpty(lastnameInput)) && valid;
    valid = markValidation(emailInput, !isEmpty(emailInput)) && valid;
    valid = markValidation(passwordInput, !isEmpty(passwordInput)) && valid;
    valid = markValidation(confirmedPasswordInput, !isEmpty(confirmedPasswordInput)) && valid;
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
    valid = markValidation(passwordInput, isPasswordSafe(passwordInput.value)) && valid;
    valid = markValidation(confirmedPasswordInput, arePasswordsEqual(passwordInput.value, confirmedPasswordInput.value)) && valid;

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

nameInput.addEventListener('keyup', _ => markValidation(nameInput, true));
lastnameInput.addEventListener('keyup', _ => markValidation(lastnameInput, true));
emailInput.addEventListener('keyup', validateEmail);
passwordInput.addEventListener('keyup', validatePassword);
passwordInput.addEventListener('keyup', validateConfirmedPassword);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);
