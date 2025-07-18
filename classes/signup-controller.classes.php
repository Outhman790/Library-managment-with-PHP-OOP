<?php
class signUpContr extends signUp
{
    private $nickName;
    private $email;
    private $CIN;
    private $address;
    private $occupation;
    private $birthDate;
    private $password;
    private $repeatPassword;
    private $phone;

    public function __construct($nickName, $email, $CIN, $address, $occupation, $birthDate, $password, $repeatPassword, $phone)
    {
        $this->nickName = $nickName;
        $this->email = $email;
        $this->CIN = $CIN;
        $this->address = $address;
        $this->occupation = $occupation;
        $this->birthDate = $birthDate;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
        $this->phone = $phone;
    }
    public function signUpUser()
    {
        if ($this->emptyInput() === false) {
            echo "<script>confirm(\"Please fill in all the inputs\");</script>";
            exit();
        }
        if ($this->isValidNickname() === false) {
            echo "<script>confirm(\"Invalid Nickname\");</script>";
            exit();
        }
        if ($this->isValidEmail() === false) {
            echo "<script>confirm(\"Invalid Email\");</script>";
            exit();
        }
        if ($this->isStrongPassword() === false) {
            echo "<script>confirm(\"Password must be at least 8 characters and include upper, lower and numbers\");</script>";
            exit();
        }
        if ($this->validatePassword() === false) {
            echo "<script>confirm(\"Passwords doesn't match\");</script>";
            exit();
        }
        if ($this->isMoroccanPhoneNumber() === false) {
            echo "<script>confirm(\"Invalid phone number\");</script>";
            exit();
        }
        if ($this->checkUserAvailability() === false) {
            echo "<script>confirm(\"User isn't available, please choose another one\");</script>";
            exit();
        }
        $this->setUser($this->nickName, $this->email, $this->password, $this->address, $this->phone, $this->CIN, $this->occupation, $this->birthDate);
    }
    private function emptyInput()
    {
        if (empty($this->nickName) || empty($this->email) || empty($this->CIN) || empty($this->address) || empty($this->occupation) || empty($this->birthDate) || empty($this->password) || empty($this->repeatPassword) || empty($this->phone)) return false;
    }
    private function isValidNickname()
    {
        $nicknameRegex = '/^[a-zA-Z0-9_-]{3,16}$/';
        return preg_match($nicknameRegex, $this->nickName) === 1;
    }

    private function isMoroccanPhoneNumber()
    {
        $phoneNumberRegex = '/^(?:\+212|0)([5-7]\d{8})$/';
        return preg_match($phoneNumberRegex, $this->phone) === 1;
    }

    private function isValidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
    private function isStrongPassword()
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
        return preg_match($pattern, $this->password) === 1;
    }
    public function validatePassword()
    {
        if ($this->password !== $this->repeatPassword) return false;
        return true;
    }
    public function checkUserAvailability()
    {
        return (!$this->checkUser($this->nickName, $this->email));
    }
}