window.onload = function() {
    var subscribeButton = document.getElementById('subscribe');
    subscribeButton.onclick = function () {
        var url = new URL(window.location.href);
        var filmId = url.searchParams.get("id");

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/subscribe?filmId=' + filmId, false);
        xhr.send();
    }
}