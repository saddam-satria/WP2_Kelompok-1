const loginAlert = document.querySelector('#login-failure');

if (loginAlert) {
  setTimeout(() => {
    loginAlert.classList.add('d-none');
  }, 2000);
}
