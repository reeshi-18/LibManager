<?php

namespace Controller;
class ViewBook
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInAdmin();
        if ($loggedIn)
        {
            echo \View\Loader::make()->render("templates/viewBook.twig", array(
                "books"=> \Model\Fetch::getAllBooks(),
            ));
        }
        else
        {
            header("Location: /login");
        }
    }
    public function post()
    {
        $search= $_POST["search_book"];
        echo \View\Loader::make()->render("templates/viewBook.twig", array(
            "books"=> \Model\Fetch::searchAllBooks($search),
        ));   
    }
}