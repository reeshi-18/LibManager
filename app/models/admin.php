<?php

namespace Model;

class Admin
{
    public static function getUserRequest()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM user WHERE stat= 'requested'");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function approveUser($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE user SET stat= 'Approved' where email=(?)");
        $stmt->execute([$email]);
    }

    public static function rejectUser($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE from user where email=(?)");
        $stmt->execute([$email]);
    }

    public static function checkBookExists($isbn)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(isbn) FROM book WHERE isbn= (?)");
        $check->execute([$isbn]);
        $count= $check->fetch();
        return $count[0];
    }

    public static function addBook($bname, $author, $genre, $isbn, $pages, $publisher, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO book (bname, author, genre, isbn, pages, publisher, quantity) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$bname, $author, $genre, $isbn, $pages, $publisher, $quantity]);
    }

    public static function getAllUsers($role)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from user WHERE role=(?) AND stat= 'approved'");
        $stmt->execute([$role]);
        $rows=$stmt->fetchAll();
        return $rows;
    }

    public static function userLog()
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM book_stats LEFT JOIN user ON book_stats.email=user.email LEFT JOIN book ON book_stats.isbn=book.isbn ORDER BY book_stats.oid ");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function getRequests()
    {
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM book_stats LEFT JOIN book ON book_stats.isbn=book.isbn LEFT JOIN user ON book_stats.email= user.email WHERE book_stats.status= 'Requested' ORDER BY book_stats.oid");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function accept($oid)
    {
        $db = \DB::get_instance();
        $date = date('Y-m-d');
        $stmt= $db->prepare("UPDATE book_stats SET status= 'Issued', issue_date= (?) WHERE oid= (?)");
        $stmt->execute([$date, $oid]);
    }

    public static function reject($oid)
    {
        $db = \DB::get_instance();
        $stmt= $db->prepare("UPDATE book_stats SET STATUS= 'Rejected' WHERE oid= (?)");
        $stmt->execute([$oid]);
    }

}