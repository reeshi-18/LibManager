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
        //set status issued
        $db = \DB::get_instance();
        $date = date('Y-m-d');
        $stmt= $db->prepare("UPDATE book_stats SET status= 'Issued', issue_date= (?) WHERE oid= (?)");
        $stmt->execute([$date, $oid]);

        //decrease quantity
        $stmt2= $db->prepare("Select book.isbn from book left join book_stats on book.isbn= book_stats.isbn where book_stats.oid=(?)");
        $stmt2->execute([$oid]);
        $isbn= $stmt2->fetch();

        //update
        $update= $db->prepare("update book set quantity=quantity-1 where isbn= (?)");
        $update->execute([$isbn[0]]);
    }

    public static function reject($oid)
    {
        $db = \DB::get_instance();
        $stmt= $db->prepare("UPDATE book_stats SET STATUS= 'Rejected' WHERE oid= (?)");
        $stmt->execute([$oid]);
    }

    public static function searchUserLog($search)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM book_stats LEFT JOIN user ON book_stats.email=user.email LEFT JOIN book ON book_stats.isbn=book.isbn WHERE (user.email LIKE (?)) OR (name LIKE (?)) OR (book.isbn LIKE (?)) OR (book.bname LIKE (?)) OR (book_stats.status LIKE (?))");
        $stmt->execute([$search."%",$search."%",$search."%",$search."%",$search."%"]);
        $rows= $stmt->fetchAll();
        return $rows;
    }

}