<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<?php
if (!isset($conn)) {
    die("Database connection failed.");
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM `student` WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    header("location: index.php?error=Student not found");
    exit();
}
$stmt->close();
?>

<?php
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $sname = trim($_POST['sname']);
    $age = intval($_POST['age']);

    if (empty($name) || empty($sname) || $age <= 0) {
        die("Invalid input data.");
    }

    $stmt = $conn->prepare("UPDATE `student` SET `name` = ?, `surname` = ?, `age` = ? WHERE `id` = ?");
    $stmt->bind_param("ssii", $name, $sname, $age, $id);

    if ($stmt->execute()) {
        exit(header('location:index.php?update_msg=Successfully updated'));
    } else {
        die("Query failed: " . $stmt->error);
    }
    $stmt->close();
}
?>

<form action="update.php?id=<?php echo $id; ?>" method="POST">
    <div class="form">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
    </div>
    <div class="form">
        <label for="sname">Surname</label>
        <input type="text" name="sname" class="form-control" value="<?php echo htmlspecialchars($row['surname']); ?>" required>
    </div>
    <div class="form">
        <label for="age">Age</label>
        <input type="number" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age']); ?>" required>
    </div>
    
    <input type="submit" class="btn btn-success" name="update" value="Update">
</form>

<?php include('footer.php'); ?>
