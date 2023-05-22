<?php
include '../includes/header.php';
$companyid = $_SESSION['companyid'];
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../assets/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body class="sb-nav-fixed">
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <div class="row">
          <div class="card mb-4">
            <div class="card-body">
              <div class="container">
                <button type="button" class="btn btn-success" onclick="location.href='http:./add_student.php'">
                  Add New
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-hover tb" id="studentinfo">
          <thead class="table-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Studentname</th>
              <th scope="col">Class</th>
              <th scope="col">StudentID</th>
              <!-- <th scope="col">Medical</th> -->
              <!-- <th scope="col">Training</th> -->
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../config/db.php";
            $query = "SELECT * FROM students WHERE companyid = '$companyid'";
            $result = mysqli_query($conn, $query);
            $id = 1;
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
                <td><?php echo $row['classname'] ?></td>
                <td><?php echo $row['student_id'] ?></td>
                <td>
                  <a href="edit_student.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen fs-5 "></i></a>
                  <a href="viewall.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-eye fs-5 "></i></a>
                  <!-- <a data-bs-toggle="modal" data-bs-target="#edit_Modal<?php echo $row['id'] ?>"><i class="fa-solid fa-eye fs-5 "></i></a> -->
                  <form action="edit_admin.php" method="post">
                    <div class="modal fade" id="edit_Modal<?php echo $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Payment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <p class="text-center"><b>Payment Receipt</b></p>
                              <!-- <hr> -->
                              <div class="flex">
                                <div class="w-50">
                                  <!-- <p>StudentID: <b><?php echo $student_id ?></b></p> -->
                                  <p>Studentname:<b> <?php echo $row['studentname'] ?></b></p>
                                  <p>StudentID: <b> <?php echo $row['student_id'] ?></b></p>
                                  <p>Classname:<b> <?php echo $row['classname'] ?></b></p>
                                </div>
                                <div class="w-50 left">
                                  <p>Payment Date: </p>
                                  <p>Paid Amount: </p>
                                  <p>Remarks: </p>
                                </div>
                              </div>
                              <!-- <hr> -->
                              <p><b>Payment Summary</b></p>
                              <table class="wborder">
                                <tr>
                                  <td width="50%">
                                    <p><b>Fee Details</b></p>
                                    <!-- <hr> -->
                                    <table width="100%">
                                      <tr>
                                        <td width="50%">Fee Type</td>
                                        <td width="50%" class='text-right'>Amount</td>
                                      </tr>
                                      <?php
                                      
                                      ?>
                                      <tr>
                                        <th>Total</th>
                                        <th class='text-right'><b></b></th>
                                      </tr>
                                    </table>
                                  </td>
                                  <td width="50%">
                                    <p><b>Payment Details</b></p>
                                    <table width="100%" class="wborder">
                                      <tr>
                                        <td width="50%">Date</td>
                                        <td width="50%" class='text-right'>Amount</td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div>
                              <button class="btn float-right btn-success mr-2" type="button" id="print">Print</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                </td>
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