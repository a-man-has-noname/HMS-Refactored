const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});



function validatePassword() {
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");
    passwd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,10}$/;

    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }

    if (password.value.match(passwd)) {
        password.setCustomValidity('');
    } else {
        password.setCustomValidity('Password must between 6 to 10 characters which contain at least one numeric digit and a special character');
    }

}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function num_gen() {
    var eightdigitrandom = Math.floor(10000000 + Math.random() * 90000000);
    document.getElementById("eightrandom").value = eightdigitrandom;
    document.getElementById("button-addon1").disabled = true;
}