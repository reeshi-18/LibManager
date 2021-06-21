<?php

namespace Controller;
session_start();
class BookReturn
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"] == "user"))
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
        \Model\Fetch::increase($oid);
    }
}