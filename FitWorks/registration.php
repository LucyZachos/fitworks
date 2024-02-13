<?php
//checks if the registration form has been submitted
if(isset($_POST['register'])){

    //connects to the MySQL database
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "fitworks";
    $link = mysqli_connect($host, $username, $password, $db);

    //takes the user input from the registration form and escapes  any special characters
    $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
    $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
    $phone_number = mysqli_real_escape_string($link, $_REQUEST['phone_number']);
    $email = mysqli_real_escape_string($link, $_REQUEST['email']);
    $passwrd = mysqli_real_escape_string($link, $_REQUEST['passwrd']);
    $fitness_goals = mysqli_real_escape_string($link, $_REQUEST['fitness_goals']);
    $workout_schedule = mysqli_real_escape_string($link, $_REQUEST['workout_schedule']);
    $fitness_level = mysqli_real_escape_string($link, $_REQUEST['fitness_level']);

    //if the connection to the database fails display an error message and exit
    if(!$link){
        die("Database connection failed: " . mysqli_connect_error()) ;
    }

    //SQL statement to insert user data into the table
    $sql = "INSERT IGNORE INTO users (first_name, last_name, phone_number, email, passwrd, fitness_goals, workout_schedule, fitness_level)
        VALUES (?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = mysqli_prepare($link, $sql);

    //Binds the parameters
    mysqli_stmt_bind_param($stmt, "ssssssss", $first_name, $last_name, $phone_number, $email, $passwrd, $fitness_goals, $workout_schedule, $fitness_level);
    mysqli_stmt_execute($stmt);

    if(mysqli_affected_rows($link) > 0){
        echo "<script> alert('Registration successful. Welcome " . $first_name . " " . $last_name . "!')</script>";

        //Redirect the user to the login page after registering
        header('Refresh: 1; url=login.html'); 
    }else{
        echo "<script> alert('This email already exists. Please try again!')</script>";
        
        //Redirect the user to the login page after registering
        header('Refresh: 1; url=registration.html'); 
        exit();
    }
    //close the MySQL connection
    mysqli_close($link);
}
?>