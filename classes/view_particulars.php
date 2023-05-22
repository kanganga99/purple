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
<html lang="en">

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
      <br>
      <br>
      <style>
        .myDiv{
          text-align: center;
        }
      </style>
      <?php
      $class_id = $_GET['id'];
      $sql = mysqli_query($conn, "SELECT SUM(fees.amount) AS total_amount FROM fees WHERE class_id LIKE '%$class_id%'");
      while ($row = mysqli_fetch_array($sql)) {
        $total_amount = $row['total_amount'];
      ?>
        <div class="myDiv">
          <button> Total Fee: <?php echo $row['total_amount'] ?></button>
        </div>

      <?php } ?>
      <div class="container-fluid px-4">
        <table class="table tb" id="fees">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Description</th>
              <th scope="col">Amount</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $class_id = $_GET['id'];
            $query = "SELECT * FROM fees WHERE class_id LIKE '%$class_id%'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['amount'] ?></td>
                <td>
                  <!-- <a data-bs-toggle="modal" data-bs-target="#edit_Modal</?php echo $row['class_id'] ?>"><i class="fa-solid fa-pen fs-5 "></i></a> -->
                  <!-- <a href="delete_fee.php?id=<?php echo $row['id'] ?>" class="link-dark" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this fee')"><i class="fa-solid fa-trash fs-5 "></i></a> -->
                  <a href="delete_fee.php?id=<?php echo $row['id'] ?>" class="link-dark" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this fee')"><i class="fa-solid fa-trash fs-5 "></i></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          <script>
            $("#fees").DataTable();
          </script>
        </table>
      </div>
  </div>
  </div>
  </main>
</body>
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
</html>