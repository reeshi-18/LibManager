<?php
require __DIR__ . "/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/login" => "\Controller\Login",
    "/register" => "\Controller\Register",
    "/admin" => "\Controller\Admin",
    "/user" => "\Controller\User",
    "/logout" => "\Controller\Logout",
    "/approveuser" => "\Controller\ApproveUser",
    "/addbook" => "\Controller\AddBook",
    "/viewbook" => "\Controller\ViewBook",
    "/viewuser" => "\Controller\ViewUser",
    "/booklist" => "\Controller\BookList",
    "/checkout" => "\Controller\Checkout",
    "/userhist" => "\Controller\UserHistory",
    "/userlog" => "\Controller\UserLog",
    "/issuebook" => "\Controller\IssueBook",
    "/accept" => "\Controller\Accept",
    "/reject" => "\Controller\Reject",
    "/return" => "\Controller\BookReturn"
));