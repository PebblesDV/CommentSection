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

    <form action="commentresult.php" method="POST">
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