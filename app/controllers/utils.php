<?php

namespace Controller;
session_start();
class Utils
{
    public static function loggedInUser()
    {
        if(!((isset($_SESSION["email"]))&& $_SESSION["role"]=="user"))
        {
            header("Location: /login");
        }
    }

    public static function loggedInAdmin()
    {
        if(!((isset($_SESSION["email"]))&& $_SESSION["role"]=="admin"))
        {
            header("Location: /login");
        }
    }
}