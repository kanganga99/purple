<?php
// session_start();
include '../includes/header.php';
$companyid = $_SESSION['companyid'];
// $transactions = $conn->query("SELECT * FROM transactions where student_id = $id ");
// $pay_arr = array();
// while($row=$transactions->fetch_array()){
// 	$pay_arr[$row['id']] = $row;
// }
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"">
                                    Add New
                                </button>
                                <div class=" modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <!-- <div class="col-lg-6"> -->
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container d-flex justify-content-center">
                                                    <form action="./add_transaction.php" method="post" style="width:50vw; min-width:300px;">
                                                        <div class="row mb-3">
                                                            <div class="mb-3 ">
                                                                <label class="form-label">StudentID</label>
                                                                <input type="text" class="form-control" name="student_id" placeholder="student_id">
                                                            </div>
                                                            <div class="mb-3 ">
                                                                <label class="form-label">Amount</label>
                                                                <input type="text" class="form-control" name="amount" placeholder="amount">
                                                            </div>

                                                            <div class="mb-3 ">
                                                                <label class="form-label">Remarks</label>
                                                                <input type="text" class="form-control" name="remarks" placeholder="remarks">
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
            <table class="table  tb" id="transactions">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">StudentID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM transactions ORDER BY id DESC LIMIT 500";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $class_id = $row['class_id'];
                        $sid = $row['student_id'];
                        $query1 = "SELECT * FROM fees WHERE class_id = '$class_id' ORDER BY id DESC LIMIT 500 ";
                        $result1 = mysqli_query($conn, $query1);
                        $query2 = "SELECT * FROM transactions WHERE student_id = '$sid' ORDER BY id DESC LIMIT 500 ";
                        $result2 = mysqli_query($conn, $query2);
                        $query3 = "SELECT * FROM students WHERE student_id = '$sid' ORDER BY id DESC LIMIT 500 ";
                        $result3 = mysqli_query($conn, $query3);

                    ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['student_id'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['remarks'] ?></td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#edit_Modal<?php echo $row['id'] ?>"><i class="fa-solid fa-pen fs-5 "></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#edit_Modal2<?php echo $row['id'] ?>"><i class="fa-solid fa-eye fs-5 "></i></a>
                                <form action="edit_transaction.php" method="post">
                                    <div class="modal fade" id="edit_Modal<?php echo $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">edit fee</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                                                    <div class="mb-3 ">
                                                        <label class="form-label">StudentID</label>
                                                        <input type="text" class="form-control" name="student_id" value="<?php echo $row['student_id'] ?>">
                                                    </div>
                                                    <div class="mb-3 ">
                                                        <label class="form-label">Amount</label>
                                                        <input type="text" class="form-control" name="amount" value="<?php echo $row['amount'] ?>">
                                                    </div>
                                                    <div class="mb-3 ">
                                                        <label class="form-label">Remarks</label>
                                                        <input type="text" class="form-control" name="remarks" value="<?php echo $row['remarks'] ?>">
                                                    </div>
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
                                <style>
                                    .flex {
                                        display: inline-flex;
                                        width: 100%;
                                    }

                                    .w-50 {
                                        width: 50%;
                                    }

                                    .text-center {
                                        text-align: center;
                                    }

                                    .text-right {
                                        text-align: right;
                                    }

                                    table.wborder {
                                        width: 100%;
                                        border-collapse: collapse;
                                    }

                                    table.wborder>tbody>tr,
                                    table.wborder>tbody>tr>td {
                                        border: 1px solid;
                                    }

                                    p {
                                        margin: unset;
                                    }

                                    .border-alert th,
                                    .border-alert td {
                                        animation: blink 200ms infinite alternate;
                                    }
                                </style>
                                <style>
                                    @media screen {
                                        #printSection {
                                            display: none;
                                        }
                                    }

                                    @media print {
                                        body * {
                                            visibility: hidden;
                                        }

                                        #printSection,
                                        #printSection * {
                                            visibility: visible;
                                        }

                                        #printSection {
                                            position: absolute;
                                            left: 0;
                                            top: 0;
                                        }
                                    }
                                </style>
                                <form action="" method="post">
                                    <div id="printThis">
                                        <div class="modal fade" id="edit_Modal2<?php echo $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
                                            <div class="modal-dialog" style="max-width: 50%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Payment Details</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <p class="text-center"><b>Payment Receipt</b></p>
                                                            <hr>
                                                            <div class="flex">
                                                                <div class="w-50">
                                                                    <?php
                                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                    ?>
                                                                        <p><b>Student name:</b><?php echo $row3['studentname'] ?></p>
                                                                        <p><b>Student ID:</b><?php echo $row3['student_id'] ?></p>
                                                                        <p><b>Class name:</b><?php echo $row3['classname'] ?></p>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="w-50">
                                                                    <p><b>Payment Date:</b><?php echo date("Y-m-d", strtotime($row['date_created'])) ?></p>
                                                                    <p><b>Paid Amount:</b><?php echo isset($row['amount']) ? $row['amount'] : '' ?></p>
                                                                    <p><b>Remarks:</b><?php echo isset($row['remarks']) ? $row['remarks'] : '' ?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <p><b>Payment Summary</b></p>
                                                            <!-- <div class="table-spacing"> -->
                                                            <table class="wborder">
                                                                <tr>
                                                                    <td>
                                                                        <p><b>Fee Details</b></p>
                                                                        <hr>
                                                                        <table class="wborder" style="width: 100%;">
                                                                            <tr>
                                                                                <td style="width: 60%;">Fee Type</td>
                                                                                <td style="width: 60%;" class="text-right">Amount</td>
                                                                            </tr><?php
                                                                                    $totalFeeAmount = 0;
                                                                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                                                                        $totalFeeAmount += $row1['amount'];
                                                                                    ?><tr>
                                                                                    <td><?php echo $row1['description'] ?></td>
                                                                                    <td class='text-right'><?php echo $row1['amount'] ?></td>
                                                                                </tr><?php
                                                                                    }
                                                                                        ?><tr>
                                                                                <th>Total</th>
                                                                                <th class='text-right'><b><?php echo $totalFeeAmount ?></b></th>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td width="50%">
                                                                        <p><b>Payment Details</b></p>
                                                                        <table width="100%" class="wborder">
                                                                            <tr>
                                                                                <th width="70%">Date</th>
                                                                                <th width="50%" class='text-right'>Amount</th>
                                                                            </tr><?php
                                                                                    $totalFeeAmount2 = 0;
                                                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                                        $totalFeeAmount2 += $row2['amount'];
                                                                                    ?><tr>
                                                                                    <td><b><?php echo date("Y-m-d", strtotime($row2['date_created'])) ?></b></td>
                                                                                    <td class='text-right'><b><?php echo $row2['amount'] ?></b></td>
                                                                                </tr><?php
                                                                                    }
                                                                                        ?><tr>
                                                                                <th>Total</th>
                                                                                <th class='text-right'><b><?php echo  $totalFeeAmount2 ?></b></th>
                                                                            </tr>
                                                                        </table>
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td>Total Payable Fee</td>
                                                                                <td class='text-right'><b><?php echo  $totalFeeAmount ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Total Paid</td>
                                                                                <td class='text-right'><b><?php echo $totalFeeAmount2 ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Balance</td>
                                                                                <td class='text-right'><b><?php echo ($totalFeeAmount - $totalFeeAmount2) ?></b></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <div>
                                                        <!-- <button class="btn float-right btn-success mr-2"  type="button" id="print">Print</button> -->
                                                        <button id="btnPrint" type="button" class="btn btn-default">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <script>
                    $("#transactions").DataTable();
                </script>
                <script>
                    document.getElementById("btnPrint").onclick = function() {
                        printElement(document.getElementById("printThis"));
                    }

                    function printElement(elem) {
                        var domClone = elem.cloneNode(true);

                        var $printSection = document.getElementById("printSection");

                        if (!$printSection) {
                            var $printSection = document.createElement("div");
                            $printSection.id = "printSection";
                            document.body.appendChild($printSection);
                        }

                        $printSection.innerHTML = "";
                        $printSection.appendChild(domClone);
                        window.print();
                    }
                </script>
            </table>
    </div>
    </div>
    </div>
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