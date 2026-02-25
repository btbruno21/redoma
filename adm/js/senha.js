const senhaInput = document.getElementById('senhaInput');
const eyeClosed = document.getElementById('eyeClosed');
const eyeOpen = document.getElementById('eyeOpen');

eyeClosed.addEventListener('click', () => {
    senhaInput.type = 'text';
    eyeClosed.style.display = 'none';
    eyeOpen.style.display = 'block';
});

eyeOpen.addEventListener('click', () => {
    senhaInput.type = 'password';
    eyeOpen.style.display = 'none';
    eyeClosed.style.display = 'block';
});