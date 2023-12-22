document.addEventListener("DOMContentLoaded", function () {
    loadMembers();

    function loadMembers() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "read.php", true);

        xhr.onload = function () {
            if (xhr.status == 200) {
                document.getElementById("members-list").innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }
});

