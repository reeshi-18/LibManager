<?php

namespace Controller;
session_start();
class UserLog
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"] == "admin"))
        {
            echo \View\Loader::make()->render("templates/userLog.twig", array(
                "orders"=> \Model\Admin::userLog(),
            ));
        }
        else
        {
            header("Location: /login");
        }
        
    }
}