// Form validation script for myProfile page
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("updateProfileForm");
  const submitBtn = document.getElementById("submitBtn");

  // Validation patterns
  const patterns = {
    password:
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    phone: /^[0-9]{10}$/, // Simple 10-digit phone number
    cin: /^[A-Z]{1,2}\d{6,8}$/,
    address: /^[a-zA-Z0-9\s,.-]{5,100}$/,
  };

  // Validation messages
  const messages = {
    password: {
      required: "Password is required",
      pattern:
        "Password must be at least 8 characters with uppercase, lowercase, number, and special character",
      minLength: "Password must be at least 8 characters long",
    },
    confirmPassword: {
      required: "Please confirm your password",
      mismatch: "Passwords do not match",
    },
    email: {
      required: "Email is required",
      pattern: "Please enter a valid email address",
    },
    phone: {
      required: "Phone number is required",
      pattern: "Please enter a valid 10-digit phone number",
    },
    cin: {
      required: "CIN is required",
      pattern: "CIN should be 1-2 letters followed by 6-8 digits",
    },
    address: {
      required: "Address is required",
      pattern: "Address should be 5-100 characters long",
    },
    occupation: {
      required: "Please select an occupation",
    },
    birthdate: {
      required: "Birthdate is required",
      future: "Birthdate cannot be in the future",
      age: "You must be at least 13 years old",
    },
  };

  // Validation functions
  function validatePassword(password) {
    if (!password)
      return { isValid: false, message: messages.password.required };
    if (password.length < 8)
      return { isValid: false, message: messages.password.minLength };
    if (!patterns.password.test(password))
      return { isValid: false, message: messages.password.pattern };
    return { isValid: true, message: "" };
  }

  function validateConfirmPassword(confirmPassword, password) {
    if (!confirmPassword)
      return { isValid: false, message: messages.confirmPassword.required };
    if (confirmPassword !== password)
      return { isValid: false, message: messages.confirmPassword.mismatch };
    return { isValid: true, message: "" };
  }

  function validateEmail(email) {
    if (!email) return { isValid: false, message: messages.email.required };
    if (!patterns.email.test(email))
      return { isValid: false, message: messages.email.pattern };
    return { isValid: true, message: "" };
  }

  function validatePhone(phone) {
    if (!phone) return { isValid: false, message: messages.phone.required };
    if (!patterns.phone.test(phone))
      return { isValid: false, message: messages.phone.pattern };
    return { isValid: true, message: "" };
  }

  function validateCIN(cin) {
    if (!cin) return { isValid: false, message: messages.cin.required };
    if (!patterns.cin.test(cin))
      return { isValid: false, message: messages.cin.pattern };
    return { isValid: true, message: "" };
  }

  function validateAddress(address) {
    if (!address) return { isValid: false, message: messages.address.required };
    if (!patterns.address.test(address))
      return { isValid: false, message: messages.address.pattern };
    return { isValid: true, message: "" };
  }

  function validateOccupation(occupation) {
    if (!occupation || occupation === "")
      return { isValid: false, message: messages.occupation.required };
    const validOccupations = ["etudiant(e)", "fonctionnaire", "femme de foyer"];
    if (!validOccupations.includes(occupation))
      return { isValid: false, message: "Please select a valid occupation" };
    return { isValid: true, message: "" };
  }

  function validateBirthdate(birthdate) {
    if (!birthdate)
      return { isValid: false, message: messages.birthdate.required };

    const today = new Date();
    const birthDate = new Date(birthdate);
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (birthDate > today)
      return { isValid: false, message: messages.birthdate.future };
    if (age < 13 || (age === 13 && monthDiff < 0))
      return { isValid: false, message: messages.birthdate.age };

    return { isValid: true, message: "" };
  }

  // Update field validation state
  function updateFieldValidation(field, isValid, message) {
    const errorElement = document.getElementById(field.id + "Error");
    const validElement = field.parentNode.querySelector(".valid-feedback");

    // Remove all validation classes first
    field.classList.remove("is-invalid", "is-valid");

    if (isValid) {
      field.classList.add("is-valid");
      if (errorElement) errorElement.textContent = "";
      if (validElement) validElement.style.display = "block";
    } else {
      field.classList.add("is-invalid");
      if (errorElement) errorElement.textContent = message;
      if (validElement) validElement.style.display = "none";
    }
  }

  // Real-time validation
  const passwordField = document.getElementById("password");
  const confirmPasswordField = document.getElementById("confirmPassword");
  const emailField = document.getElementById("email");
  const phoneField = document.getElementById("phone");
  const cinField = document.getElementById("cin");
  const addressField = document.getElementById("address");
  const occupationField = document.getElementById("occupation");
  const birthdateField = document.getElementById("birthdate");

  // Password validation
  passwordField.addEventListener("input", function () {
    const validation = validatePassword(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);

    // Also validate confirm password when password changes
    if (confirmPasswordField.value) {
      const confirmValidation = validateConfirmPassword(
        confirmPasswordField.value,
        this.value
      );
      updateFieldValidation(
        confirmPasswordField,
        confirmValidation.isValid,
        confirmValidation.message
      );
    }
  });

  // Confirm password validation
  confirmPasswordField.addEventListener("input", function () {
    const validation = validateConfirmPassword(this.value, passwordField.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Email validation
  emailField.addEventListener("input", function () {
    const validation = validateEmail(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Phone validation
  phoneField.addEventListener("input", function () {
    const validation = validatePhone(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // CIN validation
  cinField.addEventListener("input", function () {
    const validation = validateCIN(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Address validation
  addressField.addEventListener("input", function () {
    const validation = validateAddress(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Occupation validation
  occupationField.addEventListener("change", function () {
    const validation = validateOccupation(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Birthdate validation
  birthdateField.addEventListener("change", function () {
    const validation = validateBirthdate(this.value);
    updateFieldValidation(this, validation.isValid, validation.message);
  });

  // Form submission validation
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Validate all fields
    const passwordValidation = validatePassword(passwordField.value);
    const confirmPasswordValidation = validateConfirmPassword(
      confirmPasswordField.value,
      passwordField.value
    );
    const emailValidation = validateEmail(emailField.value);
    const phoneValidation = validatePhone(phoneField.value);
    const cinValidation = validateCIN(cinField.value);
    const addressValidation = validateAddress(addressField.value);
    const occupationValidation = validateOccupation(occupationField.value);
    const birthdateValidation = validateBirthdate(birthdateField.value);

    // Update all field states
    updateFieldValidation(
      passwordField,
      passwordValidation.isValid,
      passwordValidation.message
    );
    updateFieldValidation(
      confirmPasswordField,
      confirmPasswordValidation.isValid,
      confirmPasswordValidation.message
    );
    updateFieldValidation(
      emailField,
      emailValidation.isValid,
      emailValidation.message
    );
    updateFieldValidation(
      phoneField,
      phoneValidation.isValid,
      phoneValidation.message
    );
    updateFieldValidation(
      cinField,
      cinValidation.isValid,
      cinValidation.message
    );
    updateFieldValidation(
      addressField,
      addressValidation.isValid,
      addressValidation.message
    );
    updateFieldValidation(
      occupationField,
      occupationValidation.isValid,
      occupationValidation.message
    );
    updateFieldValidation(
      birthdateField,
      birthdateValidation.isValid,
      birthdateValidation.message
    );

    // Check if all validations pass
    const allValid =
      passwordValidation.isValid &&
      confirmPasswordValidation.isValid &&
      emailValidation.isValid &&
      phoneValidation.isValid &&
      cinValidation.isValid &&
      addressValidation.isValid &&
      occupationValidation.isValid &&
      birthdateValidation.isValid;

    if (allValid) {
      // Submit the form
      form.submit();
    } else {
      // Show error message
      alert("Please fix the validation errors before submitting the form.");
      // Scroll to first error
      const firstError = form.querySelector(".is-invalid");
      if (firstError) {
        firstError.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    }
  });

  // Initial validation on page load
  passwordField.dispatchEvent(new Event("input"));
  emailField.dispatchEvent(new Event("input"));
  phoneField.dispatchEvent(new Event("input"));
  cinField.dispatchEvent(new Event("input"));
  addressField.dispatchEvent(new Event("input"));
  if (birthdateField.value) {
    birthdateField.dispatchEvent(new Event("change"));
  }
  if (occupationField.value) {
    occupationField.dispatchEvent(new Event("change"));
  }
});
