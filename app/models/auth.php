<?php

namespace Model;

class Auth
{
    public static function createUser($name, $phone, $email, $pwd, $role, $stat)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO user (name, phone, email, pwd, role, stat) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$name, $phone, $email, $pwd, $role, $stat]);
    }

    public static function checkUserIfPresent($email)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(email) from user WHERE email= (?)");
        $check->execute([$email]);
        $count = $check->fetch();
        return $count[0];
    }

    public static function login($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from user WHERE email= (?)");
        $stmt->execute([$email]);
        $data = $stmt->fetch();
        return $data;
    }
    
}
