<?php

namespace Controller;
class UserLog
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if ($loggedIn)
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

    public function post()
    {
        $search= $_POST["search"];
        echo \View\Loader::make()->render("templates/userLog.twig", array(
            "orders"=> \Model\Admin::searchUserLog($search),
        )); 
    }
}