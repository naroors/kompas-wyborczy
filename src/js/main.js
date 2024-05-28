function openMenu() {
    const navMenu = document.querySelector(".nav-menu");
    navMenu.classList.toggle("active");
}

function countdown() {
    var now = new Date();
    var eventDate = new Date(now.getFullYear(), 5, 9);

    if (now.getMonth() > 5 || (now.getMonth() == 5 && now.getDate() > 9)) {
        eventDate.setFullYear(eventDate.getFullYear() + 1);
    }

    var currentTime = now.getTime();
    var eventTime = eventDate.getTime();

    var remainingTime = eventTime - currentTime;

    var seconds = Math.floor(remainingTime / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    document.getElementById('result').innerText = days;
}

countdown();
setInterval(countdown, 1000 * 60 * 60 * 24);