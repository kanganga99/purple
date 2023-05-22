<?php
include '../includes/header.php';
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
  echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    ' . $msg . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
<!DOCTYPE html>
<head>
  <link href="../assets/css/bootstrap.min.css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery.dataTables.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/chart.min.js"></script>
  <script src="../assets/js/datatables.js"></script>
</head>
<body class="sb-nav-fixed">
  </div>
  <div id="layoutSidenav_content">
    <main>
      <br>
      <br>
      <div class="container-fluid px-4">
        <table class="table table-hover text-center" id="studentinfo">
          <thead class="table-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Studentname</th>
              <th scope="col">StudentID</th>
              <th scope="col">Phonenumber</th>
              <th scope="col">Religion</th>
              <th scope="col">Uploads</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../config/db.php";
            //pagination
            $results_per_page = 1000;
            $test = $_GET['id'];
            $query = "SELECT * FROM students WHERE classname LIKE '%$test%'";
            $result = mysqli_query($conn, $query);
            $number_of_result = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
              $upload1 = $row['uploads'];
              $upload2 = explode('/', $upload1);
              $upload3 = str_replace('"', '', $upload2);
              $upload = str_replace("]", "", $upload3);
              $upload_file = json_decode($upload1);
            ?>
              <tr>
                <td></td>
                <td><?php echo $row['studentname'] ?></td>
                <td><?php echo $row['student_id'] ?></td>
                <td><?php echo $row['phonenumber'] ?></td>
                <td><?php echo $row['religion'] ?></td>
                
                <td><a href="../assets/images/<?php echo $upload[3]; ?>" target="_blank" class="text-primary "><i class="fa fa-download"></i><?php echo substr($upload[3], 0, 7);  ?>...</a></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          <script>
            $("#studentinfo").DataTable();
          </script>
        </table>
      </div>
  </div>
  </div>
  </div>
  </main>
  </div>
  </div>
  <style>
    table {
      counter-reset: none;
    }

    tr {
      counter-increment: rowNumber;
    }

    table tr td:first-child::before {
      content: counter(rowNumber);
    }
  </style>
</body>

</html>