const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = passwordInput.nextElementSibling;

function isEmail(email)
{
    return /\S+@\S+\.\S+/.test(email);
}

function isPasswordSafe(password)
{
    const regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return regex.test(password);
}

function arePasswordsEqual(password, confirmedPassword)
{
    return password === confirmedPassword;
}

function markValidation(element, condition)
{
    !condition ? element.classList.add('invalid') : element.classList.remove('invalid');
    //element.validity = condition;
}

function validateEmail() {
    setTimeout(function() {
        markValidation(emailInput, isEmail(emailInput.value))
    }, 1000)
}

function validatePassword() {
    //setTimeout(function () {
        markValidation(passwordInput, isPasswordSafe(passwordInput.value))
    //}, 100)
}

function validateConfirmedPassword() {
    //setTimeout(function() {
        const condition = arePasswordsEqual(
            passwordInput.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput, condition)
    //}, 100)
    //TODO po zmianie hasła powinien się zmieniać automatycznie status pola confirm-password
}

emailInput.addEventListener('keyup', validateEmail);
passwordInput.addEventListener('keyup', validatePassword);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);