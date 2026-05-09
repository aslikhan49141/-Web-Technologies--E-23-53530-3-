# Library Management System - FT_Practice1

This project is a simplified Library Management System using PHP, MySQL, HTML, and AJAX.

The main purpose of this task is to learn how a small CRUD system works using a basic MVC structure.

CRUD means:

- Create: add a new book
- Read: show all books
- Update: edit book information
- Delete: remove a book

## Folder Structure

```text
FT_Practice1
|
+-- Asset
|   +-- script.js
|
+-- Controler
|   +-- bookController.php
|
+-- Model
|   +-- db.php
|   +-- bookModel.php
|
+-- View
|   +-- home.php
|
+-- index.php
+-- library_management.sql
+-- README.md
```

## What Each Folder Does

### index.php

This is the root file.

When the user opens:

```text
http://localhost/learning-web-technologies-spring2025-2026/FT_Practice1/
```

this file redirects the user to the view page:

```php
header('location: View/home.php');
```

So the user does not need to write `View/home.php` manually in the browser.

### View

The `View` folder contains the user interface.

In this project:

```text
View/home.php
```

This file shows:

- Book add/update form
- Book title input
- Author name input
- Category input
- Availability status dropdown
- Add/Update button
- Clear button
- Table for showing all books

The View does not directly insert, update, or delete database records. It only collects user input and shows output.

### Asset

The `Asset` folder contains JavaScript.

In this project:

```text
Asset/script.js
```

This file handles all AJAX requests.

AJAX is used so the page does not reload when:

- adding a book
- showing all books
- editing a book
- deleting a book

### Controler

The `Controler` folder contains the controller file.

In this project:

```text
Controler/bookController.php
```

This file receives AJAX requests from JavaScript.

It checks the request action:

```php
if($action == "add"){
    ...
}else if($action == "list"){
    ...
}else if($action == "edit"){
    ...
}else if($action == "update"){
    ...
}else if($action == "delete"){
    ...
}
```

The controller does not write SQL directly. It calls functions from the Model.

### Model

The `Model` folder contains database-related files.

In this project:

```text
Model/db.php
Model/bookModel.php
```

`db.php` creates the database connection.

`bookModel.php` contains functions for database operations:

```php
addBook($book)
getAllBooks()
getBookById($id)
updateBook($book)
deleteBook($id)
```

These functions run SQL queries using procedural MySQLi.

## Database Setup

Open phpMyAdmin and import:

```text
FT_Practice1/library_management.sql
```

This creates the database:

```sql
library_management
```

and the table:

```sql
books
```

Table structure:

```sql
create table if not exists books(
    id int auto_increment primary key,
    title varchar(100) not null,
    author varchar(100) not null,
    category varchar(50) not null,
    status varchar(20) not null
);
```

The `id` is auto increment, so MySQL automatically creates the book id.

## Full Execution Flow

### 1. User Opens the Project

User opens:

```text
http://localhost/learning-web-technologies-spring2025-2026/FT_Practice1/
```

Then `index.php` runs.

It redirects to:

```text
View/home.php
```

### 2. View Page Loads

The browser loads:

```text
View/home.php
```

Inside the body tag:

```html
<body onload="loadBooks()">
```

This means when the page opens, JavaScript automatically calls:

```js
loadBooks()
```

So all existing books are shown in the table.

### 3. JavaScript Sends AJAX Request

Inside `Asset/script.js`, the `loadBooks()` function creates an AJAX request:

```js
let xhttp = new XMLHttpRequest();
```

Then it sends request to the controller:

```js
xhttp.open('post', '../Controler/bookController.php', true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send('action=list');
```

Important point:

The JavaScript is loaded from `View/home.php`, so the path is:

```text
../Controler/bookController.php
```

This means:

- go one folder back from `View`
- then go inside `Controler`
- then call `bookController.php`

### 4. Controller Receives Request

The controller receives:

```php
$_REQUEST['action']
```

If action is `list`, this block runs:

```php
}else if($action == "list"){
    $books = getAllBooks();
    ...
}
```

The controller calls:

```php
getAllBooks()
```

### 5. Model Talks to Database

The function `getAllBooks()` is inside:

```text
Model/bookModel.php
```

It connects to database:

```php
$con = getConnection();
```

The `getConnection()` function comes from:

```text
Model/db.php
```

Then it runs SQL:

```php
$sql = "select * from books order by id desc";
$result = mysqli_query($con, $sql);
```

Then it stores all rows inside an array:

```php
while($row = mysqli_fetch_assoc($result)){
    array_push($books, $row);
}
```

Finally it returns the books array to the controller.

### 6. Controller Sends Response

The controller creates table rows using `echo`:

```php
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
```

This HTML response goes back to AJAX.

### 7. JavaScript Shows Data

In `script.js`:

```js
if(this.readyState == 4 && this.status == 200){
    document.getElementById('bookList').innerHTML = this.responseText;
}
```

This means:

- request finished
- server response is successful
- put the returned table rows inside the table body

So the user sees all books without page reload.

## Add Book Flow

When user fills the form and clicks:

```html
Add Book
```

this function runs:

```js
saveBook()
```

Inside `saveBook()`:

```js
let title = document.getElementById('title').value;
let author = document.getElementById('author').value;
let category = document.getElementById('category').value;
let status = document.getElementById('status').value;
let action = "add";
```

Then AJAX sends:

```js
xhttp.send('action='+action+'&id='+id+'&title='+title+'&author='+author+'&category='+category+'&status='+status);
```

So the controller receives:

```php
action = add
title
author
category
status
```

In `bookController.php`:

```php
if($action == "add"){
    ...
}
```

It checks empty fields:

```php
if($title == "" || $author == "" || $category == "" || $status == ""){
    echo "All fields are required!";
}
```

If all fields are filled, it creates an array:

```php
$book = ['title'=>$title, 'author'=>$author, 'category'=>$category, 'status'=>$status];
```

Then it calls model function:

```php
$result = addBook($book);
```

In `bookModel.php`, `addBook()` runs:

```php
$sql = "insert into books values(null, '{$book['title']}', '{$book['author']}', '{$book['category']}', '{$book['status']}')";
$result = mysqli_query($con, $sql);
```

If inserted, controller says:

```php
echo "Book added successfully";
```

Then JavaScript shows the message and calls:

```js
clearForm();
loadBooks();
```

So the form becomes empty and the table updates automatically.

## Edit Book Flow

When user clicks `Edit`, this button runs:

```html
onclick='editBook(id)'
```

Example:

```js
editBook(3)
```

In `script.js`, AJAX sends:

```js
xhttp.send('action=edit&id='+id);
```

The controller receives action `edit`.

It calls:

```php
$book = getBookById($id);
```

The model runs:

```php
$sql = "select * from books where id={$id}";
```

Then the controller sends the book as JSON:

```php
echo json_encode($book);
```

JavaScript receives JSON text and converts it into object:

```js
let book = JSON.parse(this.responseText);
```

Then it fills the form:

```js
document.getElementById('book_id').value = book.id;
document.getElementById('title').value = book.title;
document.getElementById('author').value = book.author;
document.getElementById('category').value = book.category;
document.getElementById('status').value = book.status;
document.getElementById('submitBtn').value = "Update Book";
```

Now the same form becomes an update form.

## Update Book Flow

When the form has a hidden book id:

```html
<input type="hidden" name="book_id" id="book_id" value="">
```

then `saveBook()` checks:

```js
if(id != ""){
    action = "update";
}
```

So if there is an id, AJAX sends:

```text
action=update
```

The controller runs:

```php
}else if($action == "update"){
    ...
}
```

Then it calls:

```php
updateBook($book)
```

The model runs:

```php
$sql = "update books set title='{$book['title']}', author='{$book['author']}', category='{$book['category']}', status='{$book['status']}' where id={$book['id']}";
```

Then controller returns:

```php
echo "Book updated successfully";
```

JavaScript clears the form and reloads the table.

## Delete Book Flow

When user clicks Delete:

```html
onclick='deleteBook(id)'
```

JavaScript asks confirmation:

```js
let confirmDelete = confirm("Are you sure?");
```

If user clicks OK, AJAX sends:

```js
xhttp.send('action=delete&id='+id);
```

Controller receives action `delete`.

Then it calls:

```php
deleteBook($id)
```

The model runs:

```php
$sql = "delete from books where id={$id}";
```

Then JavaScript reloads the table:

```js
loadBooks();
```

## MVC Idea in Simple Words

MVC means:

```text
Model View Controller
```

### View

View means what the user sees.

In this project:

```text
View/home.php
```

It has HTML form and table.

### Controller

Controller means request handler.

In this project:

```text
Controler/bookController.php
```

It decides what to do based on action:

```text
add, list, edit, update, delete
```

### Model

Model means database logic.

In this project:

```text
Model/bookModel.php
```

It contains SQL queries and database functions.

## Why One Controller Is Used

The task says to use one controller for multiple submissions.

So instead of creating:

```text
addBook.php
updateBook.php
deleteBook.php
listBook.php
```

we use one file:

```text
bookController.php
```

And we send different actions:

```text
action=add
action=list
action=edit
action=update
action=delete
```

Then the controller uses `if/else if`.

This is simple and exam-friendly.

## How to Solve Similar Exam Problem

If you get a similar question in exam, follow this order.

### Step 1: Understand the Entity

Find what record you need to manage.

Example:

```text
Library system manages books
```

Book fields:

```text
title
author
category
status
```

For another problem, fields may be different.

Example product system:

```text
name
price
quantity
category
```

### Step 2: Create Database Table

Always create an `id` column:

```sql
id int auto_increment primary key
```

Then add required fields:

```sql
title varchar(100)
author varchar(100)
category varchar(50)
status varchar(20)
```

### Step 3: Create Folder Structure

Use:

```text
Asset
Controler
Model
View
```

### Step 4: Create db.php

Write database connection:

```php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "database_name";

function getConnection(){
    global $host;
    global $dbuser;
    global $dbpass;
    global $dbname;

    $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
    return $con;
}
```

### Step 5: Create Model Functions

For CRUD, create these functions:

```php
function addData($data){}
function getAllData(){}
function getDataById($id){}
function updateData($data){}
function deleteData($id){}
```

For this project:

```php
addBook()
getAllBooks()
getBookById()
updateBook()
deleteBook()
```

### Step 6: Create Controller

Use one controller file and check action:

```php
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];

    if($action == "add"){

    }else if($action == "list"){

    }else if($action == "edit"){

    }else if($action == "update"){

    }else if($action == "delete"){

    }
}
```

### Step 7: Create View

Create HTML form.

Give every input an `id`, because JavaScript needs to collect values using:

```js
document.getElementById('title').value;
```

Also create a table body with id:

```html
<tbody id="bookList">
</tbody>
```

AJAX will put table rows here.

### Step 8: Create AJAX Functions

Usually you need:

```js
loadBooks()
saveBook()
editBook(id)
deleteBook(id)
clearForm()
```

For another project, rename based on entity.

Example for product:

```js
loadProducts()
saveProduct()
editProduct(id)
deleteProduct(id)
clearForm()
```

## Important Exam Pattern

Remember this flow:

```text
View form/button
    |
JavaScript AJAX
    |
Controller action check
    |
Model function
    |
Database query
    |
Controller echo response
    |
JavaScript updates page
```

This is the full AJAX MVC CRUD flow.

## Common Mistakes

### Wrong Path

If JavaScript is loaded from `View/home.php`, controller path should be:

```js
../Controler/bookController.php
```

because `Controler` is outside `View`.

### Forgetting action

If you do not send action:

```js
xhttp.send('action=list');
```

then controller will not know what to do.

### Forgetting id During Update

For update, hidden id is important:

```html
<input type="hidden" id="book_id">
```

Without id, the system cannot know which book to update.

### Forgetting loadBooks()

After add, update, or delete, call:

```js
loadBooks();
```

Otherwise database changes happen, but the table will not update immediately.

## How to Run

1. Start Apache and MySQL from XAMPP.
2. Open phpMyAdmin.
3. Import:

```text
FT_Practice1/library_management.sql
```

4. Open browser:

```text
http://localhost/learning-web-technologies-spring2025-2026/FT_Practice1/
```

5. Add, edit, update, and delete books.

## Short Summary

This project works like this:

```text
home.php shows the form
script.js sends AJAX request
bookController.php receives request
bookModel.php runs database query
db.php provides database connection
controller returns response
script.js updates the page
```

If you understand this flow, you can solve similar MVC AJAX CRUD problems in the exam.
