<?php
session_start();
include 'config/connections.php';
include 'config/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pesafy | Shift Reports</title>
    <?php include 'source/meta/meta.php'; ?>
    <?php include 'source/link/link.php'; ?>
    <?php include 'source/link/edit&add.php'; ?>
    <style>
        .modal-content {
            width: 800px !important;
        }
    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <?php include 'source/sidebar/sidebar.php'; ?>
                    <?php include 'source/header/header.php'; ?>
                    <div class="right_col" role="main">
                        <div id="displaymessage" class="col-md-12 "></div>
                        <div class="">
                            <div class="page-title">
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Available Shift</h2>
                                            <div class="col-md-8 float-right">
                                                <div class="col-md-6">
                                                    <input type="text" id="daterange_shifts" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <button class="btn btn-success"><a href="assign_shift" class="text-white">Assign shift</a></button>
                                           
                                           
                                           
                                                        <button class="btn btn-info"><a href="shift" class="text-white">Creat Shifts</a></button>
                                                        <li><a class="collapse-link"><em class="fa fa-chevron-up"></em></a></li>
                                                        <li><a class="close-link"><em class="fa fa-close"></em></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-md-3 float-right">
                                                        <h5 class="border-bottom">Organization:</h5>
                                                        <select id="organizations" class="organizations form-control">
                                                            <?php
                                                            $extraq = "";
                                                            $usertype = $_SESSION['usertype'];
                                                            if ($usertype == 'manager' || $usertype == 'cashier') {
                                                                $extraq = " AND shift.org_id ='$org_id'";
                                                            }
                                                            $extraqli = "";
                                                            if ($usertype == 'general manager') {
                                                                $extraqli = " AND group_id ='$group_id'";
                                                            }
                                                            $query = mysqli_query($con, "SELECT shift.org_id, organization.organization_name FROM shift INNER JOIN organization ON shift.org_id=organization.id WHERE shift.company_id='$cid' $extraq $extraqli GROUP BY shift.org_id");
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                $selected = '';
                                                                if (isset($_COOKIE['org_id'])) {
                                                                    if ($_COOKIE['org_id'] == $row['org_id']) {
                                                                        $selected = 'selected';
                                                                    }
                                                                }
                                                            ?>
                                                                <option value="<?php echo $row['org_id']; ?>" <?php echo $selected ?>><?php echo $row['organization_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="card-box table-responsive">
                                                        <table id="datatable-shifts" class="table table-striped" style="width:100%">
                                                            <caption> </caption>
                                                            <thead>
                                                                <tr>
                                                                    <th>Shift Name</th>
                                                                    <th>Start Date</th>
                                                                    <th>End Date</th>
                                                                    <th>Shift Ranges</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $extra = "";
                                                                $usertype = $_SESSION['usertype'];
                                                                if ($usertype == 'manager' || $usertype == 'cashier') {
                                                                    $extra = " AND org_id ='$org_id'";
                                                                }
                                                                $extra_sql = '';
                                                                if (isset($_COOKIE['org_id'])) {
                                                                    $cookie_group = $_COOKIE['org_id'];
                                                                    $extra_sql = "AND org_id='$cookie_group'";
                                                                }
                                                                $month = date('m');
                                                                if (date('d') < 6) {
                                                                    $month = date('m', strtotime("-1 month"));
                                                                }

                                                                $sql = "SELECT * FROM shift WHERE  DATE_FORMAT(startdate,'%m') ='$month' AND company_id='$cid' $extra $extra_sql";
                                                                $resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));
                                                                while ($row = mysqli_fetch_assoc($resultset)) {
                                                                    $shift_id = $row['id'];
                                                                    $shift_name = $row['shift_name'];
                                                                    $startdate = $row['startdate'];
                                                                    $enddate = $row['enddate'];
                                                                ?>
                                                                    <tr id="<?php echo $row['id']; ?>">
                                                                        <td><?php echo $shift_name; ?></td>
                                                                        <td><?php echo $startdate; ?></td>
                                                                        <td><?php echo $enddate; ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-success float-right shiftarray" id="<?php echo $row["id"]; ?>">View shift</button>
                                                                        </td>
                                                                        <td>
                                                                            <a class="add" title="Add" data-toggle="tooltip" id="<?php echo $shift_id; ?>"> <em class="material-icons">&#xE03B;</em></a>
                                                                            <a class="edit" title="Edit" data-toggle="tooltip" id="<?php echo $shift_id; ?>"><em class="material-icons">&#xE254;</em></a>
                                                                            <a class="delete" title="Delete" data-toggle="tooltip" id="<?php echo $shift_id; ?>"><em class="material-icons">&#xE872;</em></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include 'source/footer/footer.php' ?>
        <!-- /footer content -->
    </div>
    </div>
    <?php include 'source/script/script.php' ?>
    <?php include 'source/script/shift_script.php'; ?>
</body>

</html>
<div id="viewshift" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewshiftTitle">Shifts Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="shift_detail">
            </div>
            <div id="message" style="color:#1f7a1f;text-align:center;font-size:30px"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success updateshift">Update</button>
            </div>
        </div>
    </div>
</div>