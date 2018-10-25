<?php

namespace App;

class User {
    private $modelUser;

    public function __construct(\App\Model\User $modelUser)
    {
        $this->modelUser = $modelUser;
    }

    public function new(String $email, String $password)
    {
        $this->modelUser->email = $email;
        $this->modelUser->password = password_hash($password, PASSWORD_DEFAULT);
        $this->modelUser->id_ext = uniqid();
        $this->modelUser->save();

        return $this->modelUser;
    }

    public function checkExistUserByEmail(String $email)
    {   
        $user = $this->modelUser->find('all', 
            array(
                'conditions' => array(
                    'email=?',$email
                )
            )
        );

        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
    }
}