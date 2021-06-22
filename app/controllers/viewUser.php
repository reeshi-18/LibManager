<?php

namespace Controller;
class ViewUser
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if($loggedIn)
        {
            echo \View\Loader::make()->render("templates/viewUser.twig", array(
                "users"=> \Model\Admin::getAllUsers("user"),
                "admins"=> \Model\Admin::getAllUsers("admin"),
            ));
        }
        else
        {
            header("Location: /login");
        }
    }
}