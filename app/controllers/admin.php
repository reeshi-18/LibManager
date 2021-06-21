<?php

namespace Controller;

session_start();
class Admin
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"] == "admin")) {
            echo \View\Loader::make()->render("templates/admin.twig");
        } else {
            header("Location: /login");
        }
    }
}
