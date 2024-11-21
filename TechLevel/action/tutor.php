<?php

include './db.php'; 

if (isset($_POST['status'])) {
    $status = $_POST['status'];

    if ($status == 'add_tutor') {
        $name = $_POST['name'];
        $telNo = $_POST['tel_no'];
        $pass = $_POST['pass'];

        $sql = "INSERT INTO tutor (name, tel_no) VALUES ('$name', '$telNo')";
        if ($conn->query($sql) === TRUE) {

            add_user($telNo , $pass , $conn ,"tutor");
            echo json_encode(array("status" => "success", "message" => "Tutor added successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error adding tutor: " . $conn->error));
        }
    }

    if ($status == 'update_tutor') {
        $telNo = $_POST['tel_no'];
        $pass = $_POST['pass'];
        $id_query = "SELECT ID FROM users WHERE Username = '$telNo'";
        $id_result = mysqli_query($conn, $id_query);
    
        if ($id_result) {
            $id_row = mysqli_fetch_assoc($id_result);
            $id = $id_row['ID'];
    
            $update_query = "UPDATE users SET Password = '$pass' WHERE ID = '$id'";
            $update_result = mysqli_query($conn, $update_query);
    
            if ($update_result) {
                echo json_encode(array("status" => "success", "message" => "Tutor record updated successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
        }
    
        mysqli_close($conn);
    }

    if ($status == 'delete_tutor') {
        $tutorId = $_POST['tutor_id'];

        $sql = "DELETE FROM tutor WHERE tutor_id = $tutorId";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("status" => "success", "message" => "Tutor deleted successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error deleting tutor: " . $conn->error));
        }
    }

    if ($status == 'list_tutors') {
        $sql = "SELECT * FROM tutor";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $tutors = array();
            while ($row = $result->fetch_assoc()) {
                $tutors[] = $row;
            }
            echo json_encode(array("status" => "success", "tutors" => $tutors));
        } else {
            echo json_encode(array("status" => "error", "message" => "No tutors found."));
        }
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'fetch_Tutor') {
    $tutorId = $_POST['tutor_id'];

    $sql = "SELECT tutor_id, name, tel_no FROM tutor WHERE tutor_id = $tutorId"; 
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $tutorData = $result->fetch_assoc();
        echo json_encode(array("status" => "success", "tutorData" => $tutorData));
    } else {
        echo json_encode(array("status" => "error", "message" => "Tutor data not found."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'total_num_of_tutor') {
    $query = "SELECT COUNT(*) AS total_tutors FROM tutor";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_tutors = $row['total_tutors'];

        mysqli_close($conn);

        echo json_encode(array("status" => "success", "total_tutors" => $total_tutors));
    } else {
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));

        mysqli_close($conn);
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