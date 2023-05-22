<?php
include "../config/db.php";
session_start();
if (isset($_POST['submit'])) {
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  // $id = $_POST['id'];
  $student_id = $_POST['student_id'];
  $studentname = $_POST['studentname'];
  $religion = $_POST['religion'];
  $phonenumber = $_POST['phonenumber'];
  $classname = isset($classname) ? $classname : '';
  if (isset($_POST['classname'])) {
    $classname = $_POST['classname'];
  }
  $classname = $_POST["classname"];
  $path = "/";
  $uploads = [];
  $countfiles = count($_FILES['uploads']['name']);
  for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['uploads']['name'][$i];
    $targetfilepath = '../assets/images/' . $filename;
    echo $targetfilepath;
    // Upload file
    move_uploaded_file($_FILES['uploads']['tmp_name'][$i], $targetfilepath);
    //  array_push($uploads,$filename);
    $uploads[] = $targetfilepath;
    $uploads2 = json_encode($uploads);
  }
  $sql = "UPDATE students SET studentname='$studentname',religion='$religion',phonenumber='$phonenumber',student_id='$student_id',classname='$classname'
  uploads='$uploads2' WHERE id = '$id'";
  // medical = '$chk'
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: ./index.php?msg=Data updated");
  } else {
    echo "Failed:" . mysqli_error($conn);
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
      <?php
      $id = isset($_GET['id']) ? $_GET['id'] : '';
      $sql = "SELECT * FROM students WHERE `id` = '$id' LIMIT 1";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $uploads0 = $row['uploads'];
        $uploads = json_decode($uploads0);
      ?>
        <form action="" method="POST" enctype="multipart/form-data">
          <section id="Form1">
            <div class="row">
              <div class="col">
                <label class="form-label" for="studentname">Student Name</label>
                <input type="text" name="studentname" id="inputStudentname" placeholder="Studentname" class="form-control" value="<?php echo $row['studentname'] ?>" required />
              </div>
            </div>
            <label class="form-label" for="student_id">Student ID</label>
            <input type="text" name="student_id" id="inputstudent_id" placeholder="student_id" class="form-control" value="<?php echo $row['student_id'] ?>" required />
            <label class="form-label" for="inputreligion" name="religion">Religion</label><br>
            <?php
            $dbselected = $row['religion'];
            $options = array('Christian', 'Muslim', 'Others');
            echo "<select name='religion' class='form-select'>";
            foreach ($options as $option) {
              if ($dbselected == $option) {
                echo "<option selected='selected' value='$option'>$option</option>";
              } else {
                echo "<option name='religion' value='$option'>$option</option>";
              }
            }
            echo "</select>";
            ?>
            <label class="form-label" for="inputphonenumber">Phone Number</label>
            <input type="text" name="phonenumber" id="inputphonenumber" placeholder="phonenumber" class="form-control" value="<?php echo $row['phonenumber'] ?>" required />
            <label for="form-label">Class</label>
            <input type="text" name="classname" id="inputclassname" placeholder="classname" class="form-control" value="<?php echo $row['classname'] ?>" required/>
            <br>
            <div class="btn-box justify-content-center">
              <br><button type="button" id="Next1">Next</button>
            </div>
          </section>
          <section id="Form2">
            <b>Upload student's details here in PDF format</b><br><br>
            <!-- <input type="file" class="required" name="uploads[]" onchange="return fileValidation()" id="uploads" multiple /><br><br> -->
            <div class="input-group mb-3">
              <label class="input-group-text" for="uploads"></label>
              <input type="file" class="form-control" name="uploads[]" onchange="return fileValidation()" id="uploads" multiple><br>
            </div>
            <div class="row">
              <?php foreach ($uploads as $upload) {
              ?>
                <a href="<?php echo $upload; ?>" style="width:120px;" class=" btn btn-outline-success" target="_blank">uploaded file<?php echo substr($upload[3], 2, 9);  ?></a>
              <?php
              }
              ?>
            </div><br>
            <div class="btn-box justify-content-center">
              <br><button type="button" id="Back2" class="documents">Back</button><br>
              <button type="submit" name="submit">Submit</button>
          </section>
    </div>
    </form>
  <?php
      }
  ?>
  <dvi class="step-row">
    <div id="progress"></div>
    <div class="step-col"><small>Personal details</small></div>
    <!-- <div class="step-col"><small>Status info</small></div> -->
    <div class="step-col"><small>Documents</small></div>
  </dvi>
  </div>
  <script>
    var Form1 = document.getElementById("Form1");
    var Form2 = document.getElementById("Form2");
    // var Form3 = document.getElementById("Form3");

    var Next1 = document.getElementById("Next1");
    // var Next2 = document.getElementById("Next2");
    // var Back1 = document.getElementById("Back1");
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
        $('#inputstudent-id:input').attr('placeholder', 'please fill in this field');
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

    Back2.onclick = function() {
      Form1.style.left = "70px";
      Form2.style.left = "600px";
      progress.style.width = "200px";
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