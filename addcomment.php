<?php
    function save_data($nam, $eml, $com) {

        include 'connection.php';

        $sql = $conn->prepare("INSERT INTO Comments (name, email, comment) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $nam, $eml, $com);

        if (!$sql->execute()) {
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
            return;
        } elseif (empty($comment)) {
            return;
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