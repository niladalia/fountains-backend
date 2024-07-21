<?php

namespace App\Security;

class Admin extends User
{
    public function __construct()
    {
        $this->setUsername('ADMIN');
        $this->setRoles(['ROLE_ADMIN']);
    }
}