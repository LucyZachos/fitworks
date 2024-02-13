<?php
  if (isset($_POST['login'])) {

    //Validates the user email and password:
    if (empty($_POST['email']) || empty($_POST['passwrd'])) {
      echo '<script>alert("Error: The email or password cannot be left empty. Please try again")</script>';
      header('Refresh: 1; url=login.html');
      exit();
    }

    //connects to the MySQL database
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitworks";
    $link = mysqli_connect($host, $username, $password, $dbname);

    //Retrieve the email and password
    $email = $_POST['email'];
    $passwrd = $_POST['passwrd'];

    //takes the user input from the registration form and escapses any special characters
    $email = mysqli_real_escape_string($link, $email);
    $passwrd = mysqli_real_escape_string($link, $passwrd);

    //Retrieve the user's information from the database:
    $query = "SELECT * FROM users WHERE email='$email' AND passwrd='$passwrd'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    //if the record exists then redirect to account
    if ($row) { 

      //Start a session to store user email
      session_start(); 
      $_SESSION['email'] = $row['email'];

      //Get the users first name and last name
      $first_name = $row['first_name']; 
      $last_name = $row['last_name'];

      //If the user logs in successfully an alert is displayed and they are redirected to the account page
      echo "<script>alert('Welcome " . $first_name . " " . $last_name . "!')</script>"; 
      header('Refresh: 0.1; url=account.php'); 
      exit();
    } else { 

      //If the user logs is unsuccessful an alert is displayed and the login page will relaod for them to try again
      echo '<script>alert("Error: Please ensure you have entered the correct email address and password.")</script>'; 
      header('Refresh: 1; url=login.html');
      exit();
    }
  }
?> 