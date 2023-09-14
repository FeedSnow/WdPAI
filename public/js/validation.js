function markValidation(element, condition)
{
    !condition ? element.classList.add('invalid') : element.classList.remove('invalid');
    return condition;
}

function isEmpty(input)
{
    const empty = (input.value === "");
    markValidation(input, empty);
    return empty;
}