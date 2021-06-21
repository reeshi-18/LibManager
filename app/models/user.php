<?php

namespace Model;

class User
{

    public static function checkIfReq($isbn, $email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT count(email) FROM book_stats WHERE isbn= (?) AND email= (?) AND (status = 'Requested' OR status= 'Issued')");
        $stmt->execute([$isbn, $email]);
        $count= $stmt->fetch();
        return $count[0];
    }
    
    public static function issueRequest($isbn, $email, $status)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("INSERT into book_stats (isbn,email, status, request_date) VALUES (?,?,?,?)");
        $date = date('Y-m-d');
        $stmt->execute([$isbn, $email, $status, $date]);
    }

    public static function userHistory($email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book_stats LEFT JOIN book ON book_stats.isbn=book.isbn WHERE email= (?)");
        $stmt->execute([$email]);
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function bookIssue($email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book_stats LEFT JOIN book on book.isbn= book_stats.isbn WHERE email= (?) AND status= 'Issued'");
        $stmt->execute([$email]);
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function bookReturn($oid)
    {
        //set status as return
        $db = \DB::get_instance();
        $date = date('Y-m-d');
        $stmt= $db->prepare("UPDATE book_stats SET status= 'Returned', return_date= (?) WHERE oid= (?)");
        $stmt->execute([$date, $oid]);

        //increase quantity
        $stmt2= $db->prepare("Select book.isbn from book left join book_stats on book.isbn= book_stats.isbn where book_stats.oid=(?)");
        $stmt2->execute([$oid]);
        $isbn= $stmt2->fetch();

        //update
        $update= $db->prepare("update book set quantity=quantity+1 where isbn= (?)");
        $update->execute([$isbn[0]]);
    }
}