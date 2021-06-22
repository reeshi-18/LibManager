<?php

namespace Controller;

class AddBook
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();
        echo \View\Loader::make()->render("templates/addBook.twig");
    }

    public function post()
    {
        $bname = $_POST["name"];
        $isbn = $_POST["isbn"];
        $author = $_POST["author"];
        $genre = $_POST["genre"];
        $publisher = $_POST["publisher"];
        $page = $_POST["page"];
        $quantity = $_POST["quantity"];

        $check = \Model\Admin::checkBookExists($isbn);

        if ($check === 0) {
            \Model\Admin::addBook($bname, $author, $genre, $isbn, $page, $publisher, $quantity);
            echo \View\Loader::make()->render("templates/addBook.twig", array(
                "posted" => true,
            ));
        } else {
            echo \View\Loader::make()->render("templates/addBook.twig", array(
                "exists" => true,
            ));
        }
    }
}
