<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library Management System</title>
</head>
<body onload="loadBooks()">
        <h1>University Library Management System</h1>

        <form method="post" action="../Controler/bookController.php">
            <fieldset>
                <legend>Book Information</legend>
                <input type="hidden" name="book_id" id="book_id" value="">

                Book Title:
                <input type="text" name="title" id="title" value=""> <br>

                Author Name:
                <input type="text" name="author" id="author" value=""> <br>

                Category:
                <input type="text" name="category" id="category" value=""> <br>

                Availability:
                <select name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select> <br>

                <input type="button" name="submit" id="submitBtn" value="Add Book" onclick="saveBook()">
                <input type="button" name="cancel" value="Clear" onclick="clearForm()">
            </fieldset>
        </form>

        <h3 id="message"></h3>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author Name</th>
                <th>Category</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
            <tbody id="bookList">
            </tbody>
        </table>

        <script src="../Asset/script.js"></script>
</body>
</html>
