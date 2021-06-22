<?php

namespace Controller;

class ViewBook
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        echo \View\Loader::make()->render("templates/viewBook.twig", array(
            "books" => \Model\Fetch::getAllBooks(),
        ));
    }
    public function post()
    {
        $search = $_POST["search_book"];
        echo \View\Loader::make()->render("templates/viewBook.twig", array(
            "books" => \Model\Fetch::searchAllBooks($search),
        ));
    }
}
