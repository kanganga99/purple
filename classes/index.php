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
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <!-- <script src="../assets/js/main.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
  <div class="main-panel">
    <div class="content-wrapper">
      <h4 class="mt-4">Classes</h4>
      <div class="row">
        <div class="card col-12 mb-4">
          <div class="card-body">
            <div class="container">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add New
              </button>
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Add new class</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="container d-flex justify-content-center">
                        <form action="add_class.php" method="post" style="width:50vw; min-width:300px;">
                          <div class="row mb-3">
                            <div class="col">
                              <label class="form-label">Class Name</label>
                              <input type="text" class="form-control" name="classname" placeholder="classname">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col">
                              <label class="form-label">Level</label>
                              <input type="text" class="form-control" name="level" placeholder="level">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div>
                              <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          include "../config/db.php";
          // //pagination
          $results_per_page = 100;
          $query = "SELECT * FROM classes WHERE companyid = '$companyid'";
          $result = mysqli_query($conn, $query);
          $number_of_result = mysqli_num_rows($result);
          $number_of_page = ceil($number_of_result / $results_per_page);
          if (!isset($_GET['page'])) {
            $page = 1;
          } else {
            $page = $_GET['page'];
          }
          $page_first_result = ($page - 1) * $results_per_page;
          $query = "SELECT *FROM classes WHERE companyid = '$companyid' LIMIT " . $page_first_result . ',' . $results_per_page;
          $result = mysqli_query($conn, $query);
          $id = 1;
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="col-md-4">
              <div class="col-md-1"></div>
              <div class="card text-black mb-4" style="display: flex;">
                <div class="color2 ">
                  <div class="card-body" style="background-color: #D1D1D1;">Class: <?php echo $row['classname'] ?></div>
                  <div class="card-footer d-flex  ">
                    <a class="small text-white" href="view_class.php?id=<?php echo $row['id'] ?>"></a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i>
                      <form action="edit_class.php" method="post">
                        <div class="modal fade" id="edit_Modal<?php echo $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <label for="id">ID: <?php echo $row['id']; ?></label>
                                <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" style="display:none">
                                <input type="text" name="classname" class="form-control" value=" <?php echo $row['classname'] ?>"><br>
                                <input type="text" name="level" class="form-control" value=" <?php echo $row['level'] ?>"><br>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="editbtn" id="editbtn" class="btn btn-primary">update</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div class="" style="float:right;">
                    <a href="view_class.php?id=<?php echo $row['classname'] ?>"><button type="button" class="btn btn-outline-success">view</button> </a>
                    <!-- <a href="view_particulars.php?id=<?php echo $row['id'] ?>" class="link-dark mx-2" title="delete" class="btn btn-outline-success " onclick="return confirm('Are you sure you want to delete this class')"><button type="button" class="btn btn-outline-danger">Particulars</button></a> -->
                    <a href="view_particulars.php?id=<?php echo $row['id'] ?>" class="link-dark mx-2" title="delete" class="delete "><button type="button" class="btn btn-outline-success">Particulars</button></a>
                    <!-- <button type="button" id="<?php echo $row['id'] ?> " class="btn btn-primary MybtnModal">Open Modal Using jQuery</button> -->
                    <!-- <a data-bs-toggle="modal" data-bs-target="#edit_Modal<?php echo $row['id'] ?>"><i class="fa-solid fa-pen fs-5 "></i></a> -->
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
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