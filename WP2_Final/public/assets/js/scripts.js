const loginAlert = document.querySelector('#login-failure');
const errorMessages = document.querySelectorAll('#error-message');

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
