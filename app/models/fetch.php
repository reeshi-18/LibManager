<?php

namespace Model;

class Fetch
{
    public static function getAllBooks()
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book");
        $stmt->execute();
        $rows=$stmt->fetchAll();
        return $rows;
    }

    public static function searchAllBooks($search)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book WHERE (bname LIKE (?)) OR (isbn LIKE (?)) OR (author LIKE (?)) OR (genre LIKE (?)) OR (publisher LIKE (?))");
        $stmt->execute([$search."%",$search."%",$search."%",$search."%",$search."%"]);
        $rows=$stmt->fetchAll();
        return $rows;
    }

    public static function findBook($isbn)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book WHERE isbn= (?)");
        $stmt->execute([$isbn]);
        $data= $stmt->fetchAll();
        return $data;
    }   

    
}


