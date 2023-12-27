async function reg(data) {
    let response = await fetch("php/add_editor_to_track_script.php", {
        method: "POST",
        body: data,
    });
    if (response.ok) {
        inputNickname = document.getElementById('nickname');
        let nicknameValid = document.getElementById("nicknameValid");
        let result = await response.json();
        if (result.noNickname) {
            inputLogin.classList.add('is-invalid');
            nicknameValid.innerHTML = 'Такого исполнителя не существует';
        }
        else if (result.editorInList){
            inputLogin.classList.add('is-invalid');
            nicknameValid.innerHTML = 'Этот исполнитель уже есть на этом треке';
        }   
        else if (result.redirect) {
            document.location.href = result.redirect;
        }
    } else {
        alert("Ошибка загрузки");
    }
}

uploadForm = document.getElementById("uploadForm");
uploadForm.addEventListener("submit", (e) => {
    console.log("Запрос отправлен");
    e.preventDefault();
    const formData = JSON.stringify({
        nickname: uploadForm.nickname.value
    });
    reg(formData);
});



