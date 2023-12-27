function update() {
    var formData = new FormData(document.getElementById('uploadForm'));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/update_track_script.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.location.href = "tracks_from_editor.php";
        }
    };

    xhr.send(formData);
}