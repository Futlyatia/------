function checkPassword(input){
    let check = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!"#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]).{6,}$/;
    let valid = check.test(input.value);

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
    }
}
async function changePassword(data){
    let response = await fetch("php/update_password_script.php", {
        method: "POST",
        body: data,
    });
    if (response.ok){
        inputOldPassword = document.getElementById('oldPassword');
        inputPassword = document.getElementById('password');
        let oldPasswordValid = document.getElementById('oldPasswordValid');
        let passwordValid = document.getElementById('passwordValid');
        let result = await response.json();
        if (result.wrongPassword){
            inputOldPassword.classList.add('is-invalid');
            oldPasswordValid.innerHTML = "Неправильный пароль";
        }
        else if (result.similarPasswords){
            inputOldPassword.classList.add('is-invalid');
            passwordValid.innerHTML = "Введите новый пароль";
        }
        else{
            inputOldPassword.classList.remove('is-invalid');
            document.location.href = result.redirect;
        }
    }
    else{
        alert("Ошибка загрузки");
    }
}
formChangePassword = document.getElementById("formChangePassword");
formChangePassword.addEventListener("submit", (e) => {
    console.log("Запрос отправлен");
    e.preventDefault();
    const formChangePasswordData = JSON.stringify({
        oldPassword: formChangePassword.oldPassword.value,
        password: formChangePassword.password.value
    });
    changePassword(formChangePasswordData);
});