<?php

namespace Controller;

class Register
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig");
    }
    public function post()
    {

        $role = $_POST["role"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $status= "requested";

        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            $epwd = crypt($pwd, $salt);
        }

        $check = \Model\Auth::checkUserIfPresent($email);

        
            if (!($check)) 
            {
                \Model\Auth::createUser($name, $phone, $email, $epwd, $role, $status);
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "posted" => true,
                ));
            } 
            else {
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "exists" => true,
                ));
            }
        
    }
}
