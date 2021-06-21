<?php

namespace Controller;
session_start();
class UserHistory
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"] == "user"))
        {
            echo \View\Loader::make()->render("templates/userHistory.twig", array(
                "orders"=> \Model\User::userHistory($_SESSION["email"])
            ));
        }
        else
        {
            header("Location: /login");
        }
        
    }
}