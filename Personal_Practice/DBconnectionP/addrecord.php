<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $age=$_POST['age'];
    $email=trim($_POST['email']);
    $hobby=isset($_POST['hobby']) ? $_POST['hobby'] : [];
    $gender=$_POST['gender'];
    $password=password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $confirm_password=trim($_POST['confirm_password']);

    // Validation
    $errors = [];
    
    // Check if passwords match
    if(trim($_POST['password']) !== $confirm_password){
        $errors[] = "Passwords do not match!";
    }
    
    // Check email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email address!";
    }
    
    // Check age
    if(!filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 120){
        $errors[] = "Age must be a valid whole number!";
    }
    
    if(count($errors) > 0){
        foreach($errors as $error){
            echo "<p style='color: red;'>Error: " . $error . "</p>";
        }
    } else {
        // All conditions are OK - Connect to Database
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $database = "practice";
        
        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $database);
        
        // Check connection
        if($conn->connect_error){
            echo "<p style='color: red;'>Connection Failed: " . $conn->connect_error . "</p>";
        } else {
            // Connection successful - Insert data
            $hobbies = implode(", ", (array)$hobby);
            
            $stmt = $conn->prepare("INSERT INTO student_info (name, age, email, hobbies, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sissss", $name, $age, $email, $hobbies, $gender, $password);
            
            if($stmt->execute()){
                echo "<p style='color: green;'>Record inserted successfully!</p>";
            } else {
                echo "<p style='color: red;'>Error inserting record: " . $stmt->error . "</p>";
            }
            
            $stmt->close();
            $conn->close();
        }
    }
}
?>