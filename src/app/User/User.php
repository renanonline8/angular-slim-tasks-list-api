<?php

namespace App\User;

use App\User\Exceptions\ExceptionUserNotExist;
use App\User\Exceptions\ExceptionUserAlreadyExist;

class User {
    private $modelUser;
    private $modelQuery;

    public function __construct($modelUser, $modelQuery)
    {
        $this->modelUser = $modelUser;
        $this->modelQuery = $modelQuery;
    }

    public function new(String $email, String $password)
    {
        $user = $this->modelQuery->create()
            ->filterByEmail($email)
            ->findOne();
        if(!empty($user)){
            throw new ExceptionUserAlreadyExist("Usuário já existe", 1);
        }
        $this->modelUser->setEmail($email);
        $this->modelUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $this->modelUser->setIdExt(uniqid());
        $this->modelUser->save();

        return $this->modelUser;
    }

    public function checkExistUserByEmail(String $email)
    {   
        $user = $this->findByEmail($email);

        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAuth(String $email, String $senha)
    {
        //checar se email existe

        //checar se senha é valida com email

        //retornar true
    }

    public function delete(String $email)
    {
        $userCurrent = $this->findByEmail($email);

        if (empty($userCurrent)) {
            throw new ExceptionUserNotExist("Usuário não existe", 1);
        }

        $userCurrent->delete();
        return true;
    }

    private function findByEmail(String $email)
    {
        $user = $this->modelUser->find(
            array(
                'conditions' => array(
                    'email=?', $email
                )
            )
        );
        return $user;
    }
}