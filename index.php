<?php if (isset($_GET['delete_msg'])): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_GET['delete_msg']); ?>
    </div>
<?php endif; ?>



<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container mt-4">
    <h2>ALL STUDENTS</h2>
    
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
        ADD STUDENT
    </button>

    <!--  Success/Error Messages -->
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success mt-2"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php } elseif (isset($_GET['error'])) { ?>
        <div class="alert alert-danger mt-2"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php } ?>

   
    <table class="table table-hover table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Age</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `student`";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['surname']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
                    <td>
    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" 
       onclick="return confirm('Are you sure you want to delete this student?');">
        Delete
    </a>
</td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for Adding Student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="insert.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sname">Surname</label>
                        <input type="text" name="sname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="insert" value="Insert">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- jQuery and Bootstrap Scripts (Ensure These Are Loaded) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
