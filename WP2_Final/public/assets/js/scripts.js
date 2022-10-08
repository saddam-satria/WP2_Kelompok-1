const loginAlert = document.querySelector('#login-failure');
const errorMessages = document.querySelectorAll('#error-message');
const btnBars = document.querySelector('#button-bars');
const userSidebar = document.querySelector('#user-sidebar');

if (loginAlert) {
  setTimeout(() => {
    loginAlert.remove();
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
