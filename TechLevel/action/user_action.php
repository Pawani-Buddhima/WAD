<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'reg_std') {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $telephoneNumber = $_POST['telephoneNumber'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $grade = $_POST['grade'];
    $tutor = $_POST['tutor'];
    $subject = $_POST['subject'];
    $pass = $_POST['pass'];
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Student (Name, Address, TelephoneNumber, DateOfBirth, Grade, Tutor, Subject )
            VALUES ('$name', '$address', '$telephoneNumber', '$dateOfBirth', '$grade', '$tutor', '$subject')";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "New student registered successfully");
        add_user($telephoneNumber , $pass , $conn ,"std");
    } else {
        $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    }

    $conn->close();

    echo json_encode($response);
}


if (isset($_POST['status']) && $_POST['status'] == 'reg_login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT Password, UserType FROM Users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword, $userType);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            if($userType == "tutor"){
                $response = array("status" => "success", "userType" => $userType ,"id" => id_get_using_tel_tutor($username, $conn ) );
            }elseif($userType == "std"){
                $response = array("status" => "success", "userType" => $userType ,"id" => id_get_using_tel_std($username, $conn ) );
            }elseif($userType == "admin"){
                $response = array("status" => "success", "userType" => $userType ,"id" => "defult" );
            }
        } else {
            $response = array("status" => "error", "message" => "Incorrect username or password.");
        }
    } else {
        $response = array("status" => "error", "message" => "User not found.");
    }

    $stmt->close();
    echo json_encode($response);
}


if (isset($_POST['status']) && $_POST['status'] == 'total_num_of_std') {
    $query = "SELECT COUNT(*) AS total_students FROM studentregisteredclass where status = 'accepted'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_students = $row['total_students'];

        mysqli_close($conn);
        echo json_encode(array("status" => "success", "total_students" => $total_students));
    } else {
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
        mysqli_close($conn);
    }
}

function id_get_using_tel_tutor($tel_no, $conn ) {
    $query = "SELECT tutor_id FROM tutor WHERE tel_no = '$tel_no'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $tutor_id = $row['tutor_id'];
        return $tutor_id;
    } else {
        return 0;
    }
}

function id_get_using_tel_std($tel_no, $conn ) {
    $query = "SELECT ID FROM student WHERE TelephoneNumber = '$tel_no'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $tutor_id = $row['ID'];
        return $tutor_id;
    } else {
        return 0;
    }
}

function add_user($telephoneNumber, $pass, $conn , $userType) {
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (Username, Password , userType)
            VALUES ('$telephoneNumber', '$hashedPassword' , '$userType')";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}

?>
