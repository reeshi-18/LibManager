<?php

namespace Controller;
session_start();
class Login
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/login.twig");
    }

    public function post()
    {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        $check = \Model\Auth::checkUserIfPresent($email);
        if ($check == 0) {
            echo \View\Loader::make()->render("templates/login.twig", array(
                "notExists" => true,
            ));
        } else 
        {
            
            $data = \Model\Auth::login($email);

            if($data["stat"]==="Approved")
            {
                if (crypt($pwd, $data["pwd"]) === $data["pwd"]) {
                    $_SESSION["email"] = $data["email"];
                    $_SESSION["role"]= $data["role"];
    
                    if ($_SESSION["role"] === "user") 
                    {
                        header("Location: /user");
                    } 
                    
                    if($_SESSION["role"] === "admin")
                    {
                        header("Location: /admin");
                    }
    
                } 
                else {
                    echo \View\Loader::make()->render("templates/login.twig", array(
                        "wrongPwd" => true,
                    ));
                }
            }
            else{
                echo \View\Loader::make()->render("templates/login.twig", array(
                    "pending" => true,
                ));
            }

            
        }
    }
}
