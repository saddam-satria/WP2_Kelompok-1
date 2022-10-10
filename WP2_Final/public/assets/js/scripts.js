const failureAlert = document.querySelector('#failure');
const errorMessages = document.querySelectorAll('#error-message');
const btnBars = document.querySelector('#button-bars');
const userSidebar = document.querySelector('#user-sidebar');
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

btnBars.addEventListener('click', () => {
  userSidebar.classList.toggle('user-sidebar-active');
});

btnBars.addEventListener('onhover', () => {
  userSidebar.classList.toggle('user-sidebar-active');
});

if (avatars.length > 0 && previewAvatar && avatarSelected) {
  avatars.forEach((avatar) => {
    avatar.addEventListener('click', () => {
      previewAvatar.src = avatar.src;
      avatarSelected.value = avatar.src;
    });
  });
}
