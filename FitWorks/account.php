<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>FitWorks GYM</title>
      <!-- Link the CSS file "style.css" -->
      <link rel="stylesheet" href="style.css">
   </head>

   <body>
      <form action="account.php" name="account" method="POST">

      <main>
         <!-- webpages box-form -->
         <div class="box-form">

            <!-- container for left-side of box form -->
            <div class="left">
               <div class="overlay">
                  <header>
                     <h1>Fit Gym</h1>
                  </header>
               </div>
            </div>

            <!-- container for right-side of box form -->
            <div class="right">
               <header>
                  <h3>MY ACCOUNT</h3>
               </header>
               <div class="user_info">

                  <?php
                     // Start the session
                     session_start();
                     
                     $host = "localhost";
                     $username = "root";
                     $password = "";
                     $db = "fitworks";
                     
                     // Connects to the database
                     $link = mysqli_connect($host, $username, $password, $db);
                     
                     // Checks if the connection was successful
                     if (!$link) {
                       die("Database connection failed: " . mysqli_connect_error());
                     }
                     
                     // Get the logged-in user's email address
                     $email = $_SESSION["email"]; 
                     
                     // Query the database for the user's account information
                     $query = "SELECT * FROM users WHERE email = '$email'";
                     $result = mysqli_query($link, $query);
                     
                     // Check if the query was successful and display the users account information
                     if ($result && mysqli_num_rows($result) > 0) {
                       $row = mysqli_fetch_assoc($result);
                       echo "<br> First Name: " . $row["first_name"] . "<br>";
                       echo "<br> Last Name: " . $row["last_name"] . "<br>";
                       echo "<br> Cellphone Number: " . $row["phone_number"] . "<br>";
                       echo "<br> Email Address: " . $row["email"] . "<br>";
                       echo "<br> Current Fitness Goal: " . $row["fitness_goals"] . "<br>";
                       echo "<br> Current Workout Schedule: " . $row["workout_schedule"] . "<br>";
                       echo "<br> Current Fitness Level: " . $row["fitness_level"] . "<br>";
                     } else {
                       echo "0 results";
                     }
                     // Close the database connection
                     mysqli_close($link);
                     ?>
                     
               </div>
            </div>
         </div>
      </main>
   </body>
</html>