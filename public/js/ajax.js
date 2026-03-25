$(document).ready(function () {
    $('#stateID').change(function () {
        var selectedStateId = $(this).val();
        if (selectedStateId) {
            $.ajax({
                url: '<?php echo URLROOT ?>/Estate/app/controllers/NewPropertyController.php',
                type: 'POST',
                data: { stateID: selectedStateId },
                success: function (response) {
                    $('#lgas').html(response);
                }
            });
        } else {
            $('#lgas').html('<option value="">Select...</option>');
        }
    });
});
