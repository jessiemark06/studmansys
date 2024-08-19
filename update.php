<?php
include("dbconnect.php");

// Fetch student data if ID is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $sql = "SELECT * FROM stud_table WHERE stud_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        echo "Student not found";
        exit;
    }
} else {
    echo "Invalid student ID";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['stud_name'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];

    $sql = "UPDATE stud_table SET stud_name = ?, sex = ?, birthday = ?, course = ?, section = ?, year = ?, semester = ? WHERE stud_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $student_name, $sex, $birthday, $course, $section, $year, $semester, $student_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Student updated successfully!'); window.location = 'index.php';</script>";
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Update Student</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #28a745;
        }
        .form-container {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
            margin: auto;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        .form-control {
            
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
            border: 1px solid #ced4da;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.075);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #80bdff;
        }
        .btn-clear {
            border: 2px solid #dc3545;
            color: #dc3545;
            background-color: transparent;
        }
        .btn-clear:hover {
            background-color: #dc3545;
            color: white;
        }
        .btn-submit {
            border: 2px solid #28a745;
            color: #28a745;
            background-color: transparent;
        }
        .btn-submit:hover {
            background-color: #28a745;
            color: white;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .add {
            text-align: center;
            font-size: 30px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="form-container">
                    <div class="add">Update Student</div>
                    <form method="POST">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center">Student ID</td>
                                <td class="text-center"><input type="text" class="form-control" name="stud_id" value="<?php echo htmlspecialchars($student['stud_id']); ?>" disabled></td>
                            </tr>
                            <tr>
                                <td class="text-center">Student Name</td>
                                <td class="text-center"><input type="text" class="form-control" name="stud_name" value="<?php echo htmlspecialchars($student['stud_name']); ?>" required></td>
                            </tr>
                            <tr>
                                <td class="text-center">Sex</td>
                                <td class="text-center">
                                    <input type="radio" name="sex" value="Male" id="male" <?php if ($student['sex'] == 'Male') echo 'checked'; ?> required>
                                    <label for="male" class="mr-3">Male</label>
                                    <input type="radio" name="sex" value="Female" id="female" <?php if ($student['sex'] == 'Female') echo 'checked'; ?>>
                                    <label for="female">Female</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Birthday</td>
                                <td class="text-center"><input type="date" class="form-control" name="birthday" value="<?php echo htmlspecialchars($student['birthday']); ?>" required></td>
                            </tr>
                            <tr>
                                <td class="text-center">Course</td>
                                <td class="text-center"><input type="text" class="form-control" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required></td>
                            </tr>
                            <tr>
                                <td class="text-center">Section</td>
                                <td class="text-center">
                                    <select name="section" class="form-control" required>
                                        <option value="">Select Section</option>
                                        <option value="Section1" <?php if ($student['section'] == 'Section1') echo 'selected'; ?>>Section1</option>
                                        <option value="Section2" <?php if ($student['section'] == 'Section2') echo 'selected'; ?>>Section2</option>
                                        <option value="Section3" <?php if ($student['section'] == 'Section3') echo 'selected'; ?>>Section3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Year</td>
                                <td class="text-center">
                                    <select name="year" class="form-control" required>
                                        <option value="">Select Year</option>
                                        <option value="First Year" <?php if ($student['year'] == 'First Year') echo 'selected'; ?>>First Year</option>
                                        <option value="Second Year" <?php if ($student['year'] == 'Second Year') echo 'selected'; ?>>Second Year</option>
                                        <option value="Third Year" <?php if ($student['year'] == 'Third Year') echo 'selected'; ?>>Third Year</option>
                                        <option value="Fourth Year" <?php if ($student['year'] == 'Fourth Year') echo 'selected'; ?>>Fourth Year</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Semester</td>
                                <td class="text-center">
                                    <select name="semester" class="form-control" required>
                                        <option value="">Select Semester</option>
                                        <option value="First Semester" <?php if ($student['semester'] == 'First Semester') echo 'selected'; ?>>First Semester</option>
                                        <option value="Second Semester" <?php if ($student['semester'] == 'Second Semester') echo 'selected'; ?>>Second Semester</option>
                                        <option value="Midyear" <?php if ($student['semester'] == 'Midyear') echo 'selected'; ?>>Midyear</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center no-border"></td>
                                <td class="text-center no-border">
                                    <div class="btn-container">
                                        <input type="reset" name="CLEAR" value="CLEAR" class="btn btn-clear">
                                        <input type="submit" name="SUBMIT" value="UPDATE" class="btn btn-submit">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
       
