<?php

namespace Controller;

class UserLog
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        echo \View\Loader::make()->render("templates/userLog.twig", array(
            "orders" => \Model\Admin::userLog(),
        ));
    }

    public function post()
    {
        $search = $_POST["search"];
        echo \View\Loader::make()->render("templates/userLog.twig", array(
            "orders" => \Model\Admin::searchUserLog($search),
        ));
    }
}
