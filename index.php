<?php
include("dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Students List</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .table-container {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 15px;
            overflow-x: auto;
            
        }
        .btn-add {
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        .table thead th {
            background-color: #28a745;
            color: white;
        }
        .table tbody tr:nth-of-type(even) {
            background-color: #d4edda;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: #c3e6cb;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-container {
            width: 100%;
            background-color: #28a745; /* Green background */
            padding: 15px 0;
            text-align: center;
            box-sizing: border-box;
        }
        h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            margin: 0;
            color: white;
            font-size: 36px;
            text-align: center;
            padding: 15px 0;
        }
        .btn-update, .btn-delete {
            border: none;
            color: white;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-update {
            background-color: #007bff;
        }
        .btn-update:hover {
            background-color: #0056b3;
            color: black;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
            color: black;
        }
        .btn-container {
            text-align: right;
            margin-top: 20px;
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this student?")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="header-container">
        <h1>Students List</h1>
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 btn-container">
                <a href="add.php" class="btn btn-add">Add Student</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM stud_table";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['stud_id']) . "</td>
                                    <td>" . htmlspecialchars($row['stud_name']) . "</td>
                                    <td>" . htmlspecialchars($row['sex']) . "</td>
                                    <td>" . htmlspecialchars($row['birthday']) . "</td>
                                    <td>" . htmlspecialchars($row['course']) . "</td>
                                    <td>" . htmlspecialchars($row['section']) . "</td>
                                    <td>" . htmlspecialchars($row['year']) . "</td>
                                    <td>" . htmlspecialchars($row['semester']) . "</td>
                                    <td>
                                        <a href='update.php?id=" . urlencode($row['stud_id']) . "' class='btn btn-update'>Update</a>
                                        <button onclick='confirmDelete(" . $row['stud_id'] . ")' class='btn btn-delete'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No students found</td></tr>";
                        }
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
