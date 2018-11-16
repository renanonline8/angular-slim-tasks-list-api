<?php

namespace App\User;

use App\User\Exceptions\ExceptionUserNotExist;
use App\User\Exceptions\ExceptionUserAlreadyExist;

class User {
    private $model;
    private $query;

    public function __construct($model, $query)
    {
        $this->model = $model;
        $this->query = $query;
    }

    public function new(String $email, String $password)
    {
        $user = $this->query->create()->findOneByEmail($email);

        try {
            $user = $this->findByEmail($email);
        } catch (ExceptionUserNotExist $e) {
            $this->model->setEmail($email);
            $this->model->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $this->model->setIdExt(uniqid());
            $this->model->save();
            return $this->model;
        }
        
        throw new ExceptionUserAlreadyExist("Usuário já existe", 1);
    }

    public function checkExistUserByEmail(String $email)
    {   
        $user = $this->findByEmail($email);
        return $user;
    }

    public function delete(String $email)
    {
        $userCurrent = $this->findByEmail($email);
        $userCurrent->delete();
        return true;
    }

    private function findByEmail(String $email)
    {
        $user = $this->query->create()->findOneByEmail($email);

        if (empty($user)) {
            throw new ExceptionUserNotExist("Usuário não existe", 1);
        } else {
            return $user;
        }
    }
}