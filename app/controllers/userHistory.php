<?php

namespace Controller;

session_start();
class UserHistory
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        echo \View\Loader::make()->render("templates/userHistory.twig", array(
            "orders" => \Model\User::userHistory($_SESSION["email"])
        ));
    }
}
