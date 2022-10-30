const failureAlert = document.querySelector('#failure');
const errorMessages = document.querySelectorAll('#error-message');

const avatars = document.querySelectorAll('.avatars');
const previewAvatar = document.querySelector('#preview-avatar');
const avatarSelected = document.querySelector('#avatar-selected');

const serviceInput = document.querySelector('#service_name');
const serviceList = document.querySelectorAll('.service-list');

const packageInput = document.querySelector('#package');
const packageList = document.querySelectorAll('.package-list');

const clothesInput = document.querySelector('#clothes');
const clothesList = document.querySelectorAll('.clothes-list');
const clothesBtn = document.querySelector('#clothes-btn');

const quantityInput = document.querySelector('#quantity');

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

if (serviceInput || serviceList.length > 0) {
  serviceList.forEach((service) => {
    service.addEventListener('click', () => {
      serviceInput.value = service.textContent;
    });
  });
}

if (packageInput || packageList.length > 0) {
  packageList.forEach((package) => {
    package.addEventListener('click', () => {
      packageInput.value = package.textContent;
    });
  });
}

if (clothesInput || clothesList.length > 0 || clothesBtn) {
  clothesList.forEach((clothes) => {
    clothesBtn.addEventListener('click', () => {
      clothesInput.value = clothes.textContent;
    });
  });
}

if (quantityInput) {
  quantityInput.addEventListener('change', (quantity) => {
    if (quantity.currentTarget.value.match(/\s|\D|\,<>+=-``/)) {
      quantity.currentTarget.value = '';
    }
  });
}
