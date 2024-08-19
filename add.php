<?php
include("dbconnect.php");
$sql = mysqli_query($con, "SELECT COUNT(*) AS num FROM stud_table");
$ids = mysqli_fetch_assoc($sql);
$student_id = 2024 . ($ids['num'] + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Add Student</title>
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

        .container{
            display: flex;
            justify-content:center;
            align-items:center;
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
        .add{
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
                    <div class="add">
                    Add student
                 </div>
             <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center ">Student ID</td>
                        <td class="text-center"><input type="text" class="form-control" name="stud_id1" value="<?php echo $student_id; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td class="text-center ">Student Name</td>
                        <td class="text-center"><input type="text" class="form-control" name="stud_name" required></td>
                    </tr>
                    <tr>
                        <td class="text-center ">Sex</td>
                        <td class="text-center">
                            <input type="radio" name="sex" value="Male" id="male" required><label for="male" class="mr-3"> Male</label>
                            <input type="radio" name="sex" value="Female" id="female"><label for="female"> Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center  ">Birthday</td>
                        <td class="text-center"><input type="date" class="form-control" name="birthday" placeholder="MM/DD/YYYY" required></td>
                    </tr>
                    <tr>
                        <td class="text-center ">Course</td>
                        <td class="text-center"><input type="text" class="form-control" name="course" required></td>
                    </tr>
                    <tr>
                        <td class="text-center  ">Section</td>
                        <td class="text-center"><input type="text" class="form-control" name="section" required></td>
                    </tr>
                    <tr>
                        <td class="text-center  ">Year</td>
                        <td class="text-center">
                            <select name="year" class="form-control" required>
                                <option value="">Select Year</option>
                                <option value="First Year">First Year</option>
                                <option value="Second Year">Second Year</option>
                                <option value="Third Year">Third Year</option>
                                <option value="Fourth Year">Fourth Year</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center  ">Semester</td>
                        <td class="text-center">
                            <select name="sem" class="form-control" required>
                                <option value="">Select Semester</option>
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                <option value="Midyear">Midyear</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="no-border">
                        <td class="no-border"></td>
                        <td class="text-center no-border">
                            <div class="btn-container">
                                <input type="reset" name="CLEAR" value="CLEAR" class="btn btn-clear">
                                <input type="submit" name="SUBMIT" value="SUBMIT" class="btn btn-submit">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
    </div>
    <?php
    if (isset($_POST['SUBMIT'])) {
        $id = $student_id; 
        $name = $_POST['stud_name'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];
        $course = $_POST['course'];
        $section = $_POST['section'];
        $year = $_POST['year'];
        $sem = $_POST['sem'];                                           

        $insert = mysqli_query($con, "INSERT INTO stud_table VALUES ('$id', '$name', '$sex', '$birthday', '$course', '$year', '$section', '$sem')");
        if ($insert) { 
            ?>
            <script type="text/javascript">
                alert("Added Successfully!");
                window.location = "index.php";
            </script>
            <?php
        }
    }
    ?>
</body>
</html>
