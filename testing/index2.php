<!-- this is the script that access the modal  //shift modal -->
<script>
  $(document).on('click', '.shiftarray', function() {
        var shift_id = $(this).attr("id");
        $.ajax({
            url: "source/controller/shift_fetchrecords.php",
            method: "POST",
            data: {
                shift_id: shift_id
            },
            success: function(data) {
                $('#shift_detail').html(data);
                $('#viewshift').modal('show');
            }
        });
    });
</script>
  