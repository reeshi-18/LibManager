<?php

namespace Controller;

class ViewUser
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();
        echo \View\Loader::make()->render("templates/viewUser.twig", array(
            "users" => \Model\Admin::getAllUsers("user"),
            "admins" => \Model\Admin::getAllUsers("admin"),
        ));
    }
}
