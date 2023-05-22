<?php
session_start();
include "../config/db.php";
$companyid = $_SESSION['companyid'];
if (isset($_POST['submit'])) {
  $student_id = $_POST["student_id"];
  $check_duplicate_student_id = "SELECT student_id FROM students WHERE student_id= '$student_id' ";
  $result = mysqli_query($conn, $check_duplicate_student_id);
  $count = mysqli_num_rows($result);
  if ($count > 0) {
    echo "<script>alert('student_id already exist'); window.student_id.href='./index.php';</script>";
    return false;
  }
  $studentname = $_POST["studentname"];
  $religion = $_POST["religion"];
  $phonenumber = $_POST["phonenumber"];
  $companyid = isset($companyid) ? $companyid : '';
  if (isset($_POST['companyid'])) {
    $companyid = $_POST['companyid'];
  }
  $classname = isset($classname) ? $classname : '';
  if (isset($_POST['classname'])) {
    $classname = $_POST['classname'];
  }
  $classname = $_POST["classname"];
  $companyid = $_SESSION['companyid'];
  $path = "/";
  $uploads = [];
  $countfiles = count($_FILES['uploads']['name']);
  for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['uploads']['name'][$i];
    $targetfilepath = '../assets/images/' . $filename;
    // Upload file
    move_uploaded_file($_FILES['uploads']['tmp_name'][$i], $targetfilepath);
    //  array_push($uploads,$filename);
    $uploads[] = $targetfilepath;
    $uploads2 = json_encode($uploads);
  }
  $result = mysqli_query($conn, "insert into students(student_id,studentname,religion,phonenumber,classname,uploads,companyid,class_id)
       SELECT '$student_id','$studentname','$religion','$phonenumber','$classname','$uploads2','$companyid',id FROM classes WHERE classname='$classname'");
  if ($result === TRUE) {
    header("Location: ./index.php?msg=added successfully");
  } else {
    echo "Not added";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Expenses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/add_student.css" rel="stylesheet">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>

</head>
<body>
  <div class="container">
    <div class="m-4">
      <form action="./add_student.php" method="POST" enctype="multipart/form-data">
        <section id="Form1">
          <div class="row">
            <div class="col">
              <label class="form-label" for="studentname">Student Name</label>
              <input type="studentname" class="form-control" id="inputStudentname" placeholder="Studentname" name="studentname" required>
            </div>
          </div>
          <label class="form-label" for="inputid">Student ID</label>
          <input type="ID" class="form-control" id="inputstudent_id" placeholder="Student ID" name="student_id">
          <label class="form-label" for="inputreligion">Religion</label><br>
          <select class="form-select" type="religion" name="religion">
            <option value="">Select religion</option>
            <option name="religion1">Christian</option>
            <option name="religion2">Muslims</option>
            <option name="religion3">Others</option>
          </select>
          <label class="form-label" for="inputphonenumber">Phone Number</label>
          <input type="phonenumber" class="form-control" id="inputphonenumber" placeholder="phonenumber" name="phonenumber">
          <label class="form-label">Class</label><br>
          <select class="form-select" type="classname" name="classname">
            <option value="">Select class</option>
            <?php
            $query = "SELECT classname FROM classes WHERE companyid = '$companyid' ";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              while ($optionData = $result->fetch_assoc()) {
                $option = $optionData['classname'];
            ?>
                <?php
                if (!empty($classname) && $classname == $option) {
                ?>
                  <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                <?php
                } ?>
                <option value="<?php echo $option; ?>"><?php echo $option; ?> </option>
            <?php
              }
            }
            ?>
          </select>
          <br>
          <div class="btn-box justify-content-center">
            <br><button type="button" id="Next1">Next</button>
          </div>
        </section>
        <section id="Form2">
          <b>Upload student's details here in PDF format</b><br><br><br>
          <div class="input-group mb-3">
            <label class="input-group-text" for="uploads"></label>
            <input type="file" class="form-control" name="uploads[]" onchange="return fileValidation()" id="uploads" multiple>
          </div>
          <div class="btn-box justify-content-center"><br>
            <br><button type="button" id="Back2" class="documents">Back</button><br>
            <button type="submit" name="submit">Submit</button>
          </div>
        </section>
    </div>
    </form>
    <dvi class="step-row">
      <div id="progress"></div>
      <div class="step-col"><small>Personal Details</small></div>
      <div class="step-col"><small>Documents</small></div>
    </dvi>
  </div>
  <script>
    var Form1 = document.getElementById("Form1");
    var Form2 = document.getElementById("Form2");

    var Next1 = document.getElementById("Next1");
    var Back2 = document.getElementById("Back2");

    var progress = document.getElementById("progress");

    Next1.onclick = function() {
      var studentinput = $('#inputStudentname').val();
      if (studentinput == "") {
        $('#inputStudentname:input').css(
          "border", "2px solid red");
        $('#inputStudentname:input').attr('placeholder', 'please fill in this field');
      } else {
        $('#inputStudentname:input').css(
          "border", "initial");
      }
      var student_id = $('#inputstudent_id').val();
      if (student_id == "") {
        $('#inputstudent_id:input').css(
          "border", "2px solid red");
        $('#inputstudent_id:input').attr('placeholder', 'please fill in this field');
      } else {
        $('#inputstudent_id:input').css(
          "border", "initial");
      }

      var studentphonenumumber = $('#inputphonenumber').val();
      if (studentphonenumumber == "") {
        $('#inputphonenumber:input').css(
          "border", "2px solid red");
        $('#inputphonenumber:input').attr('placeholder', 'please fill in this field');
      } else {
        $('#inputphonenumber:input').css(
          "border", "initial");
        Form1.style.left = "-450px";
        Form2.style.left = "100px";
        progress.style.width = "450px";
      }
    }

    // Back1.onclick = function() {
    //   Form1.style.left = "120px";
    //   Form2.style.left = "750px";
    //   progress.style.width = "200px";
    // }

    // Next2.onclick = function() {
    //   Form2.style.left = "-450px";
    //   Form3.style.left = "120px";
    //   progress.style.width = "660px";
    // }

    Back2.onclick = function(){
      Form1.style.left = "70px";
      Form2.style.left = "600px";
      progress.style.width ="200px";
    }

    function fileValidation() {
      var fileInput = document.getElementById('uploads');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.pdf)$/i;
      if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .pdf only.');
        fileInput.value = '';
        return false;
      } else {
        //upload preview
        header("Location: add_student.php")
      }
    }
  </script>
</body>
</html>




