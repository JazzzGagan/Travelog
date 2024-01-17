const passwordVisibile = () => {
  const x = document.getElementById("password");
  const visible = document.getElementById("icon1");
  const hide = document.getElementById("icon2");

  if (x.type === "password") {
    x.type = "text";
    visible.style.display = "block";
    hide.style.display = "none";
  } else {
    x.type = "password";
    visible.style.display = "none";
    hide.style.display = "block";
  }
};
