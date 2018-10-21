<?php
namespace App\User;

class NewUser
{
    private $modelUser;

    public function __construct(\App\Model\User $modelUser)
    {
        $this->modelUser = $modelUser;
    }

    public function new(String $email, String $password)
    {
        $this->modelUser->email = $email;
        $this->modelUser->password = password_verify($password, 'PASSWORD_DEFAULT');
        $this->modelUser->id_ext = uniqid();
        $this->modelUser->save();

        return $this->modelUser;
    }
}