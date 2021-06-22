<?php

namespace Controller;
session_start();
class UserHistory
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInUser();
        if ($loggedIn)
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