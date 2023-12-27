function uploadTrack() {
    var formData = new FormData(document.getElementById('uploadForm'));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/add_track_script.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.location.href = "question.php";
        }
    };

    xhr.send(formData);
}