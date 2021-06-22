<?php

namespace Controller;

class BookList
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        echo \View\Loader::make()->render("templates/bookList.twig", array(
            "books" => \Model\Fetch::getAllBooks(),
        ));
    }

    public function post()
    {
        $search = $_POST["search_book"];
        echo \View\Loader::make()->render("templates/bookList.twig", array(
            "books" => \Model\Fetch::searchAllBooks($search),
        ));
    }
}
