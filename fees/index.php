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
        <h4 class="mt-4">Fees</h4>
        <div class="row">
          <div class="card mb-4">
            <div class="card-body">
              <div class="container">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Add New
                </button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="container d-flex justify-content-center">
                          <form action="./add_fee.php" method="post" style="width:50vw; min-width:300px;">
                            <div class="row mb-3">
                              <div class="mb-3 ">
                                <label class="form-label">Class</label>
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
                              </div>
                              <div class="mb-3 ">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="description">
                              </div>
                              <div class="mb-3 ">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" name="amount" placeholder="amount">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <div>
                                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                              </div>
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
        </div>
        <table class="table tb" id="fees">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Description</th>
              <th scope="col">Class Name</th>
              <th scope="col">Amount</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM fees WHERE companyid='$companyid'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['classname'] ?></td>
                <td><?php echo $row['amount'] ?></td>
                <td>
                  <a data-bs-toggle="modal" data-bs-target="#edit_Modal<?php echo $row['id'] ?>"><i class="mdi mdi-pencil"></i></a>
                  <a href="delete_fee.php?id=<?php echo $row['id'] ?>" class="link-dark" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this fee particular')"><i class="mdi mdi-trash-can-outline"></i></a>
                  <form action="edit_fee.php" method="post">
                    <div class="modal fade" id="edit_Modal<?php echo $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit fee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                            <div class="mb-3 ">
                              <label class="form-label">Description</label>
                              <input type="text" class="form-control" name="description" value="<?php echo $row['description'] ?>">
                            </div>
                            <div class="mb-3 ">
                              <label class="form-label">Amount</label>
                              <input type="text" class="form-control" name="amount" value="<?php echo $row['amount'] ?>">
                            </div>
                            <!-- <div class="mb-3 ">
                              <label class="form-label">Class</label>
                              <input type="text" class="form-control" name="classname" value="<?php echo $row['classname'] ?>">
                            </div> -->
                            <label class="form-label">Class</label>
                            <select class="form-select" name="classname">
                              <?php
                              $query = "SELECT * FROM classes";
                              $results = mysqli_query($conn, $query);
                              while ($rows = mysqli_fetch_array($results)) {
                              ?>
                                <option <?php if ($rows['id'] == $row['classname']) { ?> selected="selected" <?php } ?> value='<?php echo $rows['id']; ?>'>
                                  <?php echo $rows['classname']; ?>
                                </option>
                              <?php
                              }
                              ?>
                            </select>
                            <br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div>
                              <button type="submit" class="btn btn-primary" name="submit" data-bs-dismiss="modal">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php } ?>
          </tbody>
          <script>
            $("#fees").DataTable();
          </script>
        </table>
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