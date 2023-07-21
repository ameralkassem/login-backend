<?php

    include("connection.php") ;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    
    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        
        
        header("Location: start.html"); 
        exit();
    } else {
        
        echo "Invalid email or password. Please try again.";
    }

    $stmt->close();
}


?>