<?php

namespace Controller;
session_start();
class ViewUser
{
    public function get()
    {
        if((isset($_SESSION["email"]))&&($_SESSION["role"]=="admin"))
        echo \View\Loader::make()->render("templates/viewUser.twig", array(
            "users"=> \Model\Admin::getAllUsers("user"),
            "admins"=> \Model\Admin::getAllUsers("admin"),
        ));
        else
        {
            header("Location: /login");
        }
    }
}