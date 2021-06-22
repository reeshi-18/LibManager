<?php

namespace Controller;
class User
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInUser();
        if ($loggedIn) {
            echo \View\Loader::make()->render("templates/user.twig");
        } else {
            header("Location: /login");
        }
    }
}
