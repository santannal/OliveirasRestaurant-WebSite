//background

document.addEventListener('mousemove', function (e) {
    const background = document.querySelector('.background');
    const mouseX = e.clientX;
    const mouseY = e.clientY;
    background.style.backgroundPositionX = mouseX / window.innerWidth * 100 + '%';
    background.style.backgroundPositionY = mouseY / window.innerHeight * 100 + '%';
});

//botoes navbar

