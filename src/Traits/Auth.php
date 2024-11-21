<?php
namespace App\Traits;
use App\Core\Helper as h;


trait Auth
{
    public function check()
    {
        if (isset($_SESSION['username']))
            return true;
        else
            return false;
    }
    public function signin(string $username, string $id)
    {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $id;
    }
    public function signout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
    }
}