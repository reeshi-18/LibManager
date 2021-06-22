<?php

namespace Controller;

session_start();
class BookReturn
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        echo \View\Loader::make()->render("templates/return.twig", array(
            "issues" => \Model\User::bookIssue($_SESSION["email"]),
        ));
    }

    public function post()
    {
        $oid = $_POST["id"];
        \Model\User::bookReturn($oid);
    }
}
