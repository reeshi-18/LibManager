<?php

namespace Controller;
class ApproveUser
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if ($loggedIn)
        {
            echo \View\Loader::make()->render("templates/approveUser.twig", array(
                "requests"=> \Model\Admin::getUserRequest(),
            ));
        }
        else
        {
            header("Location: /login");
        }
        
    }

    public function post()
    {
        $email= $_POST["email"];
        $status= $_POST["status"];

        if($status === "accept")
        {
            \Model\Admin::approveUser($email);
        }
        else
        {
            \Model\Admin::rejectUser($email);
        }
    }
}