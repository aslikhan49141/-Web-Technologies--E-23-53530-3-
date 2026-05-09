function loadBooks(){
    let xhttp = new XMLHttpRequest();

    xhttp.open('post', '../Controler/bookController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=list');

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('bookList').innerHTML = this.responseText;
        }
    }
}

function saveBook(){
    let id = document.getElementById('book_id').value;
    let title = document.getElementById('title').value;
    let author = document.getElementById('author').value;
    let category = document.getElementById('category').value;
    let status = document.getElementById('status').value;
    let action = "add";

    if(id != ""){
        action = "update";
    }

    let data = 'action='+action+'&id='+id+'&title='+title+'&author='+author+'&category='+category+'&status='+status;
    let xhttp = new XMLHttpRequest();

    xhttp.open('post', '../Controler/bookController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('message').innerHTML = this.responseText;
            clearForm();
            loadBooks();
        }
    }
}

function editBook(id){
    let xhttp = new XMLHttpRequest();

    xhttp.open('post', '../Controler/bookController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=edit&id='+id);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let book = JSON.parse(this.responseText);

            document.getElementById('book_id').value = book.id;
            document.getElementById('title').value = book.title;
            document.getElementById('author').value = book.author;
            document.getElementById('category').value = book.category;
            document.getElementById('status').value = book.status;
            document.getElementById('submitBtn').value = "Update Book";
            document.getElementById('message').innerHTML = "";
        }
    }
}

function deleteBook(id){
    let confirmDelete = confirm("Are you sure?");

    if(confirmDelete){
        let xhttp = new XMLHttpRequest();

        xhttp.open('post', '../Controler/bookController.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('action=delete&id='+id);

        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('message').innerHTML = this.responseText;
                loadBooks();
            }
        }
    }
}

function clearForm(){
    document.getElementById('book_id').value = "";
    document.getElementById('title').value = "";
    document.getElementById('author').value = "";
    document.getElementById('category').value = "";
    document.getElementById('status').value = "";
    document.getElementById('submitBtn').value = "Add Book";
}
