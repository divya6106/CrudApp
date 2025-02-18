<?php
include('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    $name = trim($_POST['name']);
    $sname = trim($_POST['sname']);
    $age = intval($_POST['age']);

    if (empty($name) || empty($sname) || $age <= 0) {
        header("Location: index.php?error=Invalid input data");
        exit();
    }

    
    $stmt = $conn->prepare("INSERT INTO `student` (`name`, `surname`, `age`) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $sname, $age);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        header("Location: index.php?error=Failed to add student");
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
