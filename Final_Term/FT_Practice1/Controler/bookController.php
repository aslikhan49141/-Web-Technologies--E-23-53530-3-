<?php

    require_once('../Model/bookModel.php');

    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];

        if($action == "add"){
            $title = $_REQUEST['title'];
            $author = $_REQUEST['author'];
            $category = $_REQUEST['category'];
            $status = $_REQUEST['status'];

            if($title == "" || $author == "" || $category == "" || $status == ""){
                echo "All fields are required!";
            }else{
                $book = ['title'=>$title, 'author'=>$author, 'category'=>$category, 'status'=>$status];
                $result = addBook($book);

                if($result){
                    echo "Book added successfully";
                }else{
                    echo "Book not added";
                }
            }
        }else if($action == "list"){
            $books = getAllBooks();

            if(count($books) == 0){
                echo "<tr><td colspan='6'>No book found</td></tr>";
            }else{
                foreach($books as $book){
                    echo "<tr>";
                    echo "<td>{$book['id']}</td>";
                    echo "<td>{$book['title']}</td>";
                    echo "<td>{$book['author']}</td>";
                    echo "<td>{$book['category']}</td>";
                    echo "<td>{$book['status']}</td>";
                    echo "<td>";
                    echo "<input type='button' value='Edit' onclick='editBook({$book['id']})'> ";
                    echo "<input type='button' value='Delete' onclick='deleteBook({$book['id']})'>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        }else if($action == "edit"){
            $id = $_REQUEST['id'];
            $book = getBookById($id);

            if(count($book) == 0){
                echo "Book not found";
            }else{
                echo json_encode($book);
            }
        }else if($action == "update"){
            $id = $_REQUEST['id'];
            $title = $_REQUEST['title'];
            $author = $_REQUEST['author'];
            $category = $_REQUEST['category'];
            $status = $_REQUEST['status'];

            if($id == "" || $title == "" || $author == "" || $category == "" || $status == ""){
                echo "All fields are required!";
            }else{
                $book = ['id'=>$id, 'title'=>$title, 'author'=>$author, 'category'=>$category, 'status'=>$status];
                $result = updateBook($book);

                if($result){
                    echo "Book updated successfully";
                }else{
                    echo "Book not updated";
                }
            }
        }else if($action == "delete"){
            $id = $_REQUEST['id'];

            if($id == ""){
                echo "Invalid book id";
            }else{
                $result = deleteBook($id);

                if($result){
                    echo "Book deleted successfully";
                }else{
                    echo "Book not deleted";
                }
            }
        }else{
            echo "Invalid request";
        }
    }else{
        echo "Action not found";
    }

?>
