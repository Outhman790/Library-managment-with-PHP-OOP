const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
const formWrapper = document.querySelector(".wrapper");
formWrapper.style.height = "31rem";
signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
  formWrapper.style.height = "fit-content";
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
  formWrapper.style.height = "31rem";
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};
// Query parameters
function showModal() {
  // Get the modal element
  let modal = document.getElementById("loginError");
  // Display the modal
  modal.style.display = "block";
}

if (getParameterByName("error") === "usernotfound") {
  console.log("working");
  // Show the modal
  showModal();
}
