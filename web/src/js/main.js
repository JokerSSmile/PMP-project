window.onload = function() {
}

unsubscribe = function(filmId) {
    location.href = "/unsubscribe?id=" + filmId;
}

subscribe = function(filmId) {
    location.href = "/subscribe?id=" + filmId;
}

goToUserProfile = function(userId) {
    location.href = "/profile?id=" + userId;
}