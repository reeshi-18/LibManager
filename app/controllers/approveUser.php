<?php

namespace Controller;

class ApproveUser
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();
        echo \View\Loader::make()->render("templates/approveUser.twig", array(
            "requests" => \Model\Admin::getUserRequest(),
        ));
    }

    public function post()
    {
        $email = $_POST["email"];
        $status = $_POST["status"];

        if ($status === "accept") {
            \Model\Admin::approveUser($email);
        } else {
            \Model\Admin::rejectUser($email);
        }
    }
}
