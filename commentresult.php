<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>