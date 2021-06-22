<?php

namespace Controller;
session_start();
class Utils
{
    public static function loggedInUser()
    {
        if((isset($_SESSION["email"]))&& $_SESSION["role"]=="user")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function loggedInAdmin()
    {
        if((isset($_SESSION["email"]))&& $_SESSION["role"]=="admin")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}