<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'registerForClass') {
    
    if (isset($_POST['student_id']) && isset($_POST['class_id'])) {
        $student_id = $_POST['student_id'];
        $class_id = $_POST['class_id'];
        $registration_date = date("Y-m-d");
        
        $check_query = "SELECT * FROM StudentRegisteredClass WHERE student_id = '$student_id' AND class_id = '$class_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo json_encode(array("status" => "warning", "message" => "Already registered for this class."));
        } else {
            $query = "INSERT INTO StudentRegisteredClass (student_id, class_id, registration_date , status) VALUES ('$student_id', '$class_id', '$registration_date' , 'pending')";
            
            if (mysqli_query($conn, $query)) {
                echo json_encode(array("status" => "success", "message" => "Registered successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Failed to register."));
            }
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Missing student_id or class_id."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getStudentListForTutor') {
    
    if (isset($_POST['tutor_id'])) {
        $tutor_id = $_POST['tutor_id'];

        $query = "SELECT * FROM class_tutor ct, studentregisteredclass sc , student std where ct.id = sc.class_id and std.ID = sc.student_id and ct.tutor_id = '$tutor_id'";

        $result = mysqli_query($conn, $query);

        $studentList = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $studentList[] = $row;
        }

        echo json_encode(array("status" => "success", "studentList" => $studentList));
    } else {
        echo json_encode(array("status" => "error", "message" => "Missing tutor_id."));
    }
}



if (isset($_POST['status']) && $_POST['status'] == 'studentRegRejectOrAccept') {
    
    if (isset($_POST['registration_id']) && isset($_POST['action'])) {
        $registration_id = $_POST['registration_id'];
        $action = $_POST['action'];

        if ($action == 'accept') {
            
            $update_query = "UPDATE studentregisteredclass SET status = 'accepted' WHERE registration_id = '$registration_id'";
        } elseif ($action == 'reject') {
            
            $update_query = "UPDATE studentregisteredclass SET status = 'rejected' WHERE registration_id = '$registration_id'";
        } else {
            echo json_encode(array("status" => "error", "message" => "Invalid action."));
            exit;
        }

        if (mysqli_query($conn, $update_query)) {
            echo json_encode(array("status" => "success", "message" => "Student registration status updated successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to update student registration status."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Missing registration_id or action."));
    }
}


?>
