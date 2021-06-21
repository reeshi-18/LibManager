<?php

namespace Controller;

session_start();
class User
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"] == "user")) {
            echo \View\Loader::make()->render("templates/user.twig");
        } else {
            header("Location: /login");
        }
    }
}
