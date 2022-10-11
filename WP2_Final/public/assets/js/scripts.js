const failureAlert = document.querySelector('#failure');
const errorMessages = document.querySelectorAll('#error-message');

const avatars = document.querySelectorAll('.avatars');
const previewAvatar = document.querySelector('#preview-avatar');
const avatarSelected = document.querySelector('#avatar-selected');

if (failureAlert) {
  setTimeout(() => {
    failureAlert.remove();
  }, 2000);
}

if (errorMessages && errorMessages.length > 0) {
  setTimeout(() => {
    errorMessages.forEach((element) => {
      element.remove();
    });
  }, 2000);
}

if (avatars.length > 0 && previewAvatar && avatarSelected) {
  avatars.forEach((avatar) => {
    avatar.addEventListener('click', () => {
      previewAvatar.src = avatar.src;
      avatarSelected.value = avatar.src;
    });
  });
}
