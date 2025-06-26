const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("#loginForm");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
const signupForm = document.querySelector("#signupForm");
const modal = document.getElementById("loginError");
const modalMsg = document.getElementById("errorMessage");
const bsModal = modal ? new bootstrap.Modal(modal) : null;
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
function showModal(message) {
  if (!bsModal) return;
  if (message) {
    modalMsg.textContent = message;
  }
  bsModal.show();
}

function getParameterByName(name) {
  name = name.replace(/[\[\]]/g, "\\$&");
  const url = window.location.href;
  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
  const results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

if (getParameterByName("error") === "usernotfound") {
  console.log("working");
  // Show the modal
  showModal();
}

if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);
    if (!formData.has("login")) {
      formData.append("login", "Login");
    }
    try {
      const resp = await fetch(loginForm.action, {
        method: "POST",
        body: formData,
      });
      if (resp.redirected) {
        const target = resp.url;
        const params = new URL(target).searchParams;
        const error = params.get("error");
        if (error && error !== "none") {
          showModal(error);
        } else {
          window.location.href = target;
        }
      }
    } catch (err) {
      showModal("Login failed");
    }
  });
}

if (signupForm) {
  signupForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(signupForm);
    if (!formData.has("signUp")) {
      formData.append("signUp", "Signup");
    }
    try {
      const resp = await fetch(signupForm.action, {
        method: "POST",
        body: formData,
      });
      if (resp.redirected) {
        window.location.href = resp.url;
        return;
      }
      const text = await resp.text();
      const match = text.match(/confirm\("(.+?)"\)/);
      const msg = match ? match[1] : "Signup failed";
      showModal(msg);
    } catch (err) {
      showModal("Signup failed");
    }
  });
}
