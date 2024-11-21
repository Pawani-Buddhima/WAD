<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'addFeedback') {
    $studentId = $_POST['studentId'];
    $title = $_POST['title'];
    $feedbackType = $_POST['feedbackType'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO feedback (student_id, title, feedback_type, message) VALUES ('$studentId', '$title', '$feedbackType', '$message')";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to add feedback."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getAllFeedback') {
    $student_id= $_POST['student_id'];

    $sql = "SELECT * FROM feedback where student_id = '$student_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $feedbackList = array();
        while ($row = $result->fetch_assoc()) {
            $feedbackList[] = $row;
        }
        echo json_encode(array("status" => "success", "feedbackList" => $feedbackList));
    } else {
        echo json_encode(array("status" => "error", "message" => "No feedback found."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getOneFeedback') {
    $feedbackId = $_POST['feedbackId']; 
    $sql = "SELECT * FROM feedback WHERE feedback_id = $feedbackId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $feedbackData = $result->fetch_assoc();

        echo json_encode($feedbackData);
    } else {
        echo "Feedback not found.";
    }
    $conn->close();
    exit;
}

if (isset($_POST['status']) && $_POST['status'] == 'deleteFeedback') {
    $feedbackId = $_POST['feedbackId'];
    
    $sql = "DELETE FROM feedback WHERE feedback_id = $feedbackId";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback deleted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to delete feedback."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'updateFeedback') {
    $feedbackId = $_POST['feedbackId'];
    $updatedTitle = $_POST['updatedTitle'];
    $updatedFeedbackType = $_POST['updatedFeedbackType'];
    $updatedMessage = $_POST['updatedMessage'];
    
    $sql = "UPDATE feedback SET title = '$updatedTitle', feedback_type = '$updatedFeedbackType', message = '$updatedMessage' WHERE 	feedback_id = $feedbackId";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback updated successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update feedback."));
    }
}
?>
