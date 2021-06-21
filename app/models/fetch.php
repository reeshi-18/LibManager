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
        $stmt= $db->prepare("SELECT * from book WHERE bname LIKE (?)");
        $stmt->execute([$search."%"]);
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

    public static function decrease($oid)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("Select book.isbn from book left join book_stats on book.isbn= book_stats.isbn where book_stats.oid=(?)");
        $stmt->execute([$oid]);
        $isbn= $stmt->fetch();

        $update= $db->prepare("update book set quantity=quantity-1 where isbn= (?)");
        $update->execute([$isbn[0]]);
    }

    public static function increase($oid)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("Select book.isbn from book left join book_stats on book.isbn= book_stats.isbn where book_stats.oid=(?)");
        $stmt->execute([$oid]);
        $isbn= $stmt->fetch();

        $update= $db->prepare("update book set quantity=quantity+1 where isbn= (?)");
        $update->execute([$isbn[0]]);
    }
}


