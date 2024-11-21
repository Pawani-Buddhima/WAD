
<?php
    $servername =   "localhost";
    $username = "root";
    $password = "";
    $db = "al_class";

    // Create connection
    try {
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
           # die("Connection failed: t" . $conn->connect_error);
        }else{
           # echo "Connected successfully";
        }
    } catch (Exception $e) {
        echo '0';
    }
?>

