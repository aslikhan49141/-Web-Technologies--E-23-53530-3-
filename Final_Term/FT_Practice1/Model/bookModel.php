<?php

    require_once('db.php');

    function addBook($book){
        $con = getConnection();

        if(!$con){
            return false;
        }

        $sql = "insert into books values(null, '{$book['title']}', '{$book['author']}', '{$book['category']}', '{$book['status']}')";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);

        return $result;
    }

    function getAllBooks(){
        $con = getConnection();
        $books = [];

        if(!$con){
            return $books;
        }

        $sql = "select * from books order by id desc";
        $result = mysqli_query($con, $sql);

        if($result){
            while($row = mysqli_fetch_assoc($result)){
                array_push($books, $row);
            }
        }

        mysqli_close($con);
        return $books;
    }

    function getBookById($id){
        $con = getConnection();
        $book = [];

        if(!$con){
            return $book;
        }

        $sql = "select * from books where id={$id}";
        $result = mysqli_query($con, $sql);

        if($result && mysqli_num_rows($result) == 1){
            $book = mysqli_fetch_assoc($result);
        }

        mysqli_close($con);
        return $book;
    }

    function updateBook($book){
        $con = getConnection();

        if(!$con){
            return false;
        }

        $sql = "update books set title='{$book['title']}', author='{$book['author']}', category='{$book['category']}', status='{$book['status']}' where id={$book['id']}";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);

        return $result;
    }

    function deleteBook($id){
        $con = getConnection();

        if(!$con){
            return false;
        }

        $sql = "delete from books where id={$id}";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);

        return $result;
    }

?>
