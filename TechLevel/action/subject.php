<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'add_subject') {
    $subjectName = $_POST['subject_name'];

    $sql = "INSERT INTO Subjects (name) VALUES ('$subjectName')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Subject added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding subject: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'update_subject') {
    $subjectId = $_POST['subject_id'];
    $newSubjectName = $_POST['new_subject_name'];

    $sql = "UPDATE Subjects SET name = '$newSubjectName' WHERE id = $subjectId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Subject updated successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating subject: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'delete_subject') {
    $subjectId = $_POST['subject_id'];

    $sql = "DELETE FROM Subjects WHERE id = $subjectId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Subject deleted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting subject: " . $conn->error));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'list_subject') {
    $sql = "SELECT id, name FROM subjects";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $subjects = array();
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        echo json_encode(array("status" => "success", "subjects" => $subjects));
    } else {
        echo json_encode(array("status" => "error", "message" => "No subjects found."));
    }
}
?>