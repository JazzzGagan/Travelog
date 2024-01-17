const showPopupBtn = document.querySelector(".getstarted");
const hidePopupBtn = document.querySelector(".form-popup .close-button");
const signuppopBtn = document.querySelector(".form-popup .signup");

showPopupBtn.addEventListener("click", () => {
  document.body.classList.toggle("show-popup");
});

showPopupBtn.addEventListener("click");

hidePopupBtn.addEventListener("click", () => showPopupBtn.click());
