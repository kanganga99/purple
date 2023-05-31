<?php
include '../includes/header.php';
if (isset($_POST['insert_row'])) {
  $expense_name = $_POST['expensename'];
  $sql = "INSERT INTO expenses (expensename) VALUES ('$expensename' )";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "success";
  }
}
?>
<!DOCTYPE html>
<head>
  <link href="../assets//css/bootstrap.min.css/bootstrap2.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery.dataTables.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/chart.min.js"></script>
  <script src="../assets/js/datatables.js"></script>
</head>
<style>
  .nav-link {
    color: black;
  }

  .nav-link:hover {
    color: #fff;
  }
</style>
<body>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="container-fluid px-4">
        <?php
        include "../config/db.php";
        $id = $_GET['id'];
        $sql = "SELECT * FROM students WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $upload1 = $row['uploads'];
          $upload2 = explode('/', $upload1);
          $upload3 = str_replace('"', '', $upload2);
          $upload = str_replace("]", "", $upload3);
          $upload_file = json_decode($upload1);
          $student_id = $row['student_id'];
          global $student_id;
        ?>
          <div class="col-md-3 hh " style="float:right">
            <b>Studentname:</b> <?php echo $row['studentname'] ?><br>
            <b>StudentID: </b> <?php echo $row['student_id'] ?><br>
            <b>Classname</b> <?php echo $row['classname'] ?><br>
            <b class="exp">Phonenumber: </b><?php echo $row['phonenumber'] ?><br></b>
            <!-- <b> Uploads<a href="../assets/images/</?php echo $upload[3]; ?>" target="_blank" class="text-primary "><i class="fa fa-download"></i></?php echo substr($upload[3], 0, 7); ?>...</a></b> -->
            <b> Uploads:<a href="../assets/images/<?php echo $upload[3]; ?>" target="_blank" class="text-primary "><i class="fa fa-download"></i><?php echo substr($upload[3], 0, 7); ?>...</a></b>
          </div>
          <br>
        <?php
        }
        ?>
        <table class="table " id="table">
          <thead>
            <tr class="tt">
              <th>ID</th>
              <th>remarks</th>
              <th>Date</th>
              <th>Amount(Kshs)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../config/db.php";
            $results_per_page = 1000;
            $query = mysqli_query($conn, "SELECT students.student_id,transactions.remarks, transactions.amount,transactions.date_created FROM transactions INNER JOIN students
             ON(transactions.student_id=students.student_id)WHERE students.student_id=$student_id");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
              <tr class="tt">
                <td></td>
                <td><?php echo $row['remarks'] ?></td>
                <td><?php echo $row['date_created'] ?></td>
                <td><?php echo $row['amount'] ?></td>
              </tr>
            <?php
            }
            ?>
            <div class="row">
              <div class="col-4">
              </div>
              <div class="col-8" style="float:right">
                <div class="table-responsive-sm">
                  <table class="table">
                    <?php
                    $sq = mysqli_query($conn, "SELECT SUM(transactions.amount) AS total_amount FROM transactions INNER JOIN students
                          ON(transactions.student_id=students.student_id)WHERE students.student_id=$student_id");
                    while ($row = mysqli_fetch_array($sq)) {
                      $total_amount = $row['total_amount'];
                    ?>
                      <tr>
                        <th style="width:85%">Total Amout:</th>
                        <td class="total_amount">
                          <?php echo $row['total_amount'] ?>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </tbody>
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

    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }

      #no-print {
        display: none !important;
      }
    }
  </style>
  <script>
    function PrintDoc(btn) {
      $(btn).hide();

      $(".exp").hide()
      $(".exp").hide()

      $(".tt th:nth-child(2)").hide()
      $(".tt th:nth-child(1)").hide()
      $(".tt th:nth-child(3)").hide()

      $(".tt td:nth-child(2)").hide()
      $(".tt td:nth-child(1)").hide()
      $(".tt td:nth-child(3)").hide()

      window.print();

      $(btn).show();

      $(".hh").show();
      $(".hh").show();

      location.reload();
    }
  </script>

</body>

</html>