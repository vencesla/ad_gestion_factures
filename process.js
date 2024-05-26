$(function() {
    $('table').DataTable();

    // créer un facture
    $('#create').on('click', function(e) {
        let formOrder = $("#formOrder");
        if(formOrder[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "process.php",
                data: formOrder.serialize() + '&action=create',
                success: function (response) {
                    $("#createModal").modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                      });
                      formOrder[0].reset();
                }
            });
        }
    })

    // Récup
});