<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'add_Class') {
    $grade = $_POST['grade'];
    $subjectId = $_POST['subject_id'];
    $classType = $_POST['class_type'];

    $sql = "INSERT INTO class (grade, subject_id, class_type) VALUES ('$grade', $subjectId, '$classType')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Class added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding class: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'update_Class') {
    $classId = $_POST['class_id'];
    $newClassType = $_POST['new_class_type'];

    $sql = "UPDATE class SET class_type = '$newClassType' WHERE class_id = $classId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Class updated successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating class: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'delete_Class') {
    $classId = $_POST['class_id'];

    $sql = "DELETE FROM class WHERE class_id = $classId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Class deleted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting class: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'list_Class') {
    $sql = "SELECT c.class_id, c.grade, s.name AS subject_name, c.class_type, c.time_stamp FROM class c
            INNER JOIN subjects s ON c.subject_id = s.id"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $classes = array();
        while ($row = $result->fetch_assoc()) {
            $classes[] = $row;
        }
        echo json_encode(array("status" => "success", "classes" => $classes));
    } else {
        echo json_encode(array("status" => "error", "message" => "No classes found."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'searchClass') {
    $classType = isset($_POST['classType']) ? $_POST['classType'] : '';
    $grade = isset($_POST['grade']) ? $_POST['grade'] : '';

    $sql = "SELECT class.*, subjects.name AS subject_name, subjects.status AS subject_status FROM class LEFT JOIN subjects ON class.subject_id = subjects.id WHERE 1";

    if (!empty($classType)) {
        $sql .= " AND class.class_type = '$classType'";
    }

    if (!empty($grade)) {
        $sql .= " AND class.grade = '$grade'";
    }

    $result = $conn->query($sql);

    $classData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $classData[] = $row;
        }

        echo json_encode($classData);
    } else {
        echo "No classes found.";
    }

    $conn->close();
    exit;

}


if (isset($_POST['status']) && $_POST['status'] == 'fetch_Class') {
    $classId = $_POST['class_id'];

    $sql = "SELECT c.class_id, c.grade, s.name AS subject_name, c.class_type, c.time_stamp
            FROM class c
            INNER JOIN subjects s ON c.subject_id = s.id
            WHERE c.class_id = $classId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $classData = $result->fetch_assoc();
        echo json_encode(array("status" => "success", "classData" => $classData));
    } else {
        echo json_encode(array("status" => "error", "message" => "Class not found."));
    }
    $conn->close();
}

if (isset($_POST['status']) && $_POST['status'] == 'allocate_tutor') {
    $tutor_id = $_POST['tutor_id'];
    $class_id = $_POST['class_id'];

    $check_sql = "SELECT id FROM class_tutor WHERE tutor_id = ? AND class_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $tutor_id, $class_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo 2;
    } else {
        $registration_date = date('Y-m-d');
        $status = 'allocated';

        $insert_sql = "INSERT INTO class_tutor (tutor_id, class_id, registration_date, status)
                       VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssss", $tutor_id, $class_id, $registration_date, $status);

        if ($stmt->execute()) {
            echo 1;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}

if (isset($_POST['status']) && $_POST['status'] == 'tutor_class_list') {
    $response = array(); 

    $tutor_id = $_POST['tutor_id']; 

    $sql = "SELECT class.class_id, class.grade, subjects.name , class_tutor.id as subject_name, class.class_type, class.time_stamp  , class_tutor.status 
    FROM class
    INNER JOIN class_tutor ON class.class_id = class_tutor.class_id
    LEFT JOIN subjects ON class.subject_id = subjects.id
    WHERE class_tutor.tutor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tutor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $class_list = array(); 

    while ($row = $result->fetch_assoc()) {
        $class_list[] = $row;
    }

    $stmt->close();
    $conn->close();

    if (!empty($class_list)) {
        $response['classes'] = $class_list; 
    } else {
        $response['message'] = "No classes found for the tutor.";
    }

    echo json_encode($response);
}

if (isset($_POST['status']) && $_POST['status'] == 'when_class_id_give_get_avaible_tutor_list') {
    $response = array(); 

    $class_id = $_POST['class_id']; 

    $sql = "SELECT * 
    FROM class_tutor c , tutor t 
    where t.tutor_id = c.tutor_id and  class_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $tutor_list = array(); 

    while ($row = $result->fetch_assoc()) {
        $tutor_list[] = $row;
    }

    $stmt->close();
    $conn->close();

    if (!empty($tutor_list)) {
        $response['available_tutors'] = $tutor_list; 
    } else {
        $response['message'] = "No available tutors found for the class.";
    }

    echo json_encode($response);
}

if (isset($_POST['status']) && $_POST['status'] == 'statusChangeClass') {
        $class_id = $_POST['class_id'];
        
        $status_query = "SELECT status FROM class_tutor WHERE id = ".$class_id;
        $status_result = mysqli_query($conn, $status_query);

        if ($status_row = mysqli_fetch_assoc($status_result)) {
            $current_status = $status_row['status'];
            
            $new_status = ($current_status === 'allocated') ? 'class_end' : 'allocated';
            
            $update_query = "UPDATE class_tutor SET status = '$new_status' WHERE id = ".$class_id;
            
            if (mysqli_query($conn, $update_query)) {
                echo json_encode(array("status" => "success", "message" => "Class status updated successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Failed to update class status."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Class not found."));
        }
}





?>