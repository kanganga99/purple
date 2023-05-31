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
     <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
  <!-- <script src="../assets/js/main.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>
  <div class="main-panel">
    <div class="content-wrapper">
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
                <td>
                      <a href="../assets/images/<?php echo $upload[3]; ?>" target="_blank" class="text-primary "><i class="fa fa-download"></i><?php echo substr($upload[3], 0, 7);  ?>...</a>
                      <form action="" method="post">
                    </form>
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