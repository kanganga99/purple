<!-- and this the php that fetches the modal item  -->
<?php
include '../../config/connections.php';
if (isset($_POST["shift_id"])) {
    $output = '';
    $query = "SELECT * FROM shift WHERE id ='" . $_POST["shift_id"] . "'";
    $result = mysqli_query($con, $query);
    $id = 0;
    $output .= '  
      <table>';
    while ($row = mysqli_fetch_array($result)) {
        $shift = json_decode($row['shift_ranges'], true)[0];
        foreach ($shift as $key => $value) {
            if (array_key_exists($key, $shift)) {
                $output .= '
              <td id="day' . $id++ . '"><strong>' . $key . '</strong> <br> Start:<input type="text" class="form-control shift_start" value="' . $value['start_time'] . '">End:<input type="text" class="form-control shift_end" value="' . $value['end_time'] . '"></td>
            ';
            }
        }
    }
    $output .= '</table>';
    echo $output;
}
?>
<!-- this part ndio inachukua iyo modal  -->
<td>
    <button type="button" class="btn btn-success float-right shiftarray" id="<?php echo $row["id"]; ?>">View shift</button>
</td>