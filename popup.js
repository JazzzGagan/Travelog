const showPopupBtn = document.querySelector(".getstarted");
const formPopup = document.querySelector("form-popup");
showPopupBtn.addEventListener("click", () => {
  formPopup.classList.toggle("hide");
});
