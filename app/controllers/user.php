<?php

namespace Controller;

class User
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        echo \View\Loader::make()->render("templates/user.twig");
    }
}
