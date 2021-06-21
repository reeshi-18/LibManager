<?php

namespace Controller;
session_start();
class IssueBook
{
    public function get()
    {
        if ((isset($_SESSION["email"])) && ($_SESSION["role"]=="admin"))
        {
            echo \View\Loader::make()->render("templates/issue.twig", array(
                "issues"=> \Model\Admin::getRequests(),
            ));
        }
        else
        {
            header("Location: /login");
        }
    }

    public function post()
    {
        $oid = $_POST["id"];
        $status= $_POST["status"];

        if($status== "accept")
        {
            \Model\Admin::accept($oid);
            \Model\Fetch::decrease($oid);
        }
        else
        {
            \Model\Admin::reject($oid);
        }
        
    }

}