<?php

namespace Controller;
class BookList
{
    public function get()
    {
        $loggedIn= \Controller\Utils::loggedInUser();
        if ($loggedIn) {

            echo \View\Loader::make()->render("templates/bookList.twig", array(
                "books" => \Model\Fetch::getAllBooks(),
            ));
        } else {
            header("Location: /login");
        }
    }

    public function post()
    {
        $search = $_POST["search_book"];
        echo \View\Loader::make()->render("templates/bookList.twig", array(
            "books" => \Model\Fetch::searchAllBooks($search),
        ));
    }
}
