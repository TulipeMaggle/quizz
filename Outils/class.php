<?php
class User
{
    public $id;
    public $pseudo;
    public $email;
    private $admin;

    public function __construct(array $result)
    {
        $this->id = $result['id'];
        $this->pseudo = $result['pseudo'];
        $this->email = $result['email'];
        $this->admin = $result['admin'];
    }

    public function isadmin()
    {
        if ($this->admin == false) {
            return false;
        } else {
            return true;
        }
    }
}
