<?php

namespace Controller;
class IssueBook
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if ($loggedIn)
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

        if($status === "accept")
        {
            \Model\Admin::accept($oid);
        }
        else
        {
            \Model\Admin::reject($oid);
        }
        
    }

}