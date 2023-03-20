<?php
class loginContr extends login
{
    private $nickName;
    private $password;


    public function __construct($nickName, $password)
    {
        $this->nickName = $nickName;
        $this->password = $password;
    }
    public function loginUser()
    {
        if ($this->emptyInput() === false) {
            header('location: ./index.php?error=emptyinput');
            exit();
        }

        $this->getUser($this->nickName, $this->password);
    }
    private function emptyInput()
    {
        if (empty($this->nickName) || empty($this->password)) return false;
        return true;
    }
}
