<?php
include('dbcon.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM `student` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: index.php?delete_msg=Record Deleted Successfully");
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }
}
?>
