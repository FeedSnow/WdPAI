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

    markValidation(emailInput, isEmail(emailInput.value))
}

function validatePassword() {
    if(isEmpty(passwordInput))
        return;
    markValidation(passwordInput, isPasswordSafe(passwordInput.value))
}

function validateConfirmedPassword() {
        if(isEmpty(confirmedPasswordInput))
            return;

        const condition = arePasswordsEqual(
            passwordInput.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput, condition)
}

function validateForm() {
    let valid = markValidation(emailInput, !isEmpty(emailInput));
    valid = markValidation(passwordInput, !isEmpty(passwordInput)) && valid;
    if(register) {
        valid = markValidation(nameInput, !isEmpty(nameInput)) && valid;
        valid = markValidation(surnameInput, !isEmpty(surnameInput)) && valid;
        valid = markValidation(confirmedPasswordInput, !isEmpty(confirmedPasswordInput)) && valid;
    }

    if(!valid) {
        console.log('empty');
        return false;
    }

    valid = markValidation(emailInput, isEmail(emailInput.value));
    if(register) {
        valid = markValidation(passwordInput, isPasswordSafe(passwordInput.value)) && valid;
        valid = markValidation(confirmedPasswordInput, arePasswordsEqual(passwordInput.value, confirmedPasswordInput.value)) && valid;
    }

    if(!valid) {
        console.log('bad value');
        return false;
    }

    console.log('true');
    return true;
}


