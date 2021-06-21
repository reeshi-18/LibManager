<?php

namespace Controller;

session_start();
class Checkout
{
    public function post()
    {
       $isbn = $_POST["book"][0];

        $row = \Model\Fetch::findBook($isbn);
        $email = $_SESSION["email"];

        $check = \Model\User::checkIfReq($isbn, $email);

        if ($check == 0) {
            $status = "Requested";

            \Model\User::issueRequest($isbn, $email, $status);
        }
    }
}
