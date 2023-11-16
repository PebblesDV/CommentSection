<?php
    
    function save_data($nam, $eml, $com) {

        include 'connection.php';

        $sql = $conn->prepare("INSERT INTO Comments (name, email, comment) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $nam, $eml, $com);

        if ($sql->execute()) {
            echo "New record created succesfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql->close();
        $conn->close();
    }

    $name = "";
    $email = "";
    $comment = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = check_input($_POST["name"]);
        $email = check_input($_POST["email"]);
        $comment = check_input($_POST["comment"]);

        if (empty($name) || empty($email)) {
            echo "Name and Email are required";
        } elseif (empty($comment)) {
            echo "Comment is required";
        } else {
            save_data($name, $email, $comment);
        }
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="youtube-video">
        <iframe 
        width="1120" 
        height="630" 
        src="https://www.youtube.com/embed/1UA66zOA4GQ?si=lgMLT8Nh5uZJYk9B" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        </div>

    <div class="full-form">
    <h1 class="comment-header">Add a comment:</h1>

    <form action="index.php" method="POST">
        <div class="input-fields">
          <div class="name-input">
            Name: <input type="text" name="name" value="" size="70">
          </div>
          <div>
            Email: <input type="text" name="email" value="" size="70">
          </div>
        </div>
        <div>
            <textarea class="commentarea" name="comment" cols="165" rows="10"></textarea>
        </div>
        <input type="submit" value="Send">
    </form>
    </div>

    <?php

     include 'connection.php';

     $sql = "SELECT name, comment, created_at FROM Comments";

     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='entire-comment'>";

            echo "<div class='name-and-date'>";
            echo "<h2 class='comment-name'>" . $row["name"] . "</h2>";
            echo "<p>" . $row["created_at"] . "</p>";
            echo "</div>";

            echo "<p>" . $row["comment"] . "</p>";
            echo "</div>";
        }
     } else {
        echo "No comments";
     }

     $conn->close();
    
    ?>
</body>
</html>