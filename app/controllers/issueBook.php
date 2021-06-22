<?php

namespace Controller;

class IssueBook
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        echo \View\Loader::make()->render("templates/issue.twig", array(
            "issues" => \Model\Admin::getRequests(),
        ));
    }

    public function post()
    {
        $oid = $_POST["id"];
        $status = $_POST["status"];

        if ($status === "accept") {
            \Model\Admin::accept($oid);
        } else {
            \Model\Admin::reject($oid);
        }
    }
}
