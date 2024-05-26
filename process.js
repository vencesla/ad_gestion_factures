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

    getBills();
    // Récupération de la facture
    function getBills() {
        $.ajax({
            url: 'process.php',
            type: 'post',
            data: { action: 'fetch' },
            success: function(response){
                $('#orderTable').html(response);
                $('table').DataTable({
                    order:[0, 'desc'],
                });
            }
        });
    }
    $('body').on('click', '.editBtn', function(e){
        e.preventDefault();
        $.ajax({
            url : 'process.php',
            type: 'post',
            data: {workingId: this.dataset.id},
            success: function(response) {
                let billInfo = JSON.parse(response);
                $('#customerUpdate').val(billInfo.customer);
                $('#cashierUpdate').val(billInfo.cashier);
                $('#amountUpdate').val(billInfo.amount);
                $('#receivedUpdate').val(billInfo.received);
                $('#stateUpdate').val(billInfo.state);
            }
        });
    })
});