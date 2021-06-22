<?php

namespace Controller;

class Admin
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();
        echo \View\Loader::make()->render("templates/admin.twig");
    }
}
