<?php

namespace Controller;
session_start();
class BookReturn
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInUser();
        if ($loggedIn)
        {
            echo \View\Loader::make()->render("templates/return.twig", array(
                "issues"=> \Model\User::bookIssue($_SESSION["email"]),
            ));
        }
        else
        {
            header("Location: /login");
        }
    }

    public function post()
    {
        $oid= $_POST["id"];
        \Model\User::bookReturn($oid);
    }
}