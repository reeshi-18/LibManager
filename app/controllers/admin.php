<?php

namespace Controller;
class Admin
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if ($loggedIn) {
            echo \View\Loader::make()->render("templates/admin.twig");
        } else {
            header("Location: /login");
        }
    }
}
