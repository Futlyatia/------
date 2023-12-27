function checkLogin(input){
    let check = /^[a-zA-Z\d]{3,16}$/;
    let valid = check.test(input.value);
    
        if (valid == false) {
            input.setCustomValidity("Некорректное имя");
            input.focus();
        }
        else {
            input.setCustomValidity("");
        }
    

}
function checkPassword(input){
    let check = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!"#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]).{6,}$/;
    let valid = check.test(input.value);
    let submitPassword = document.getElementById('password_submit');

    if (valid == false){
        input.setCustomValidity(
            'Пароль должен содержать минимум 6 символов, ' +
            'заглавную латинскую букву, маленькую латинскую букву, цифру, ' +
            'и минимум один из спецсимволов(!#$%&()*+,-.\/:;<=>?\\@[\]^_`{|}~\")'
        );

        input.focus();
    }
    else{
        input.setCustomValidity("");
        checkSubmitPassword(submitPassword);
    }
}

function checkSubmitPassword(input) {
    password = document.getElementById('password');
    if (password.value == input.value) {
        if (password.value == '' && input.value == ''){
        }
        else{
            input.setCustomValidity('');
        }
    } 
    else {
        input.setCustomValidity('Пароли не совпадают');
    }
}
//12Qw!+
async function reg(data) {
    let response = await fetch("php/reg_script.php", {
        method: "POST",
        body: data,
    });
    if (response.ok) {
        inputLogin = document.getElementById('login');
        let loginValid = document.getElementById("loginValid");
        let result = await response.json();
        if (result.busyLogin) {
            inputLogin.classList.add('is-invalid');
            loginValid.innerHTML = 'Такой логин существует';
        } else if (result.redirect) {
            document.location.href = result.redirect;
        }
    } else {
        alert("Ошибка загрузки");
    }
}

formRegistration = document.getElementById("formRegistration");
formRegistration.addEventListener("submit", (e) => {
    console.log("Запрос отправлен");
    e.preventDefault();
    const formData = JSON.stringify({
        login: formRegistration.login.value,
        password: formRegistration.password.value,

    });
    reg(formData);v
});



