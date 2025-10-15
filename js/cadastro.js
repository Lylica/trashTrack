const totalAvatars = 11;
let current = 1;

const avatarDisplay = document.getElementById('avatarDisplay');
const avatarInput = document.getElementById('avatarInput');

document.querySelector('.arrow.left').addEventListener('click', () => {
    current--;
    if (current < 1) current = totalAvatars;
    updateAvatar();
});

document.querySelector('.arrow.right').addEventListener('click', () => {
    current++;
    if (current > totalAvatars) current = 1;
    updateAvatar();
});

function updateAvatar() {
    const filename = `avatar${current}.png`;
    avatarDisplay.src = `avatares/${filename}`;
    avatarInput.value = filename;
}
