$(document).ready(function() {
    $('#complaintForm').on('submit', function(e) {
        e.preventDefault();
        
        var submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
        
        var formData = {
            action: 'submit',
            category: $('#complaintCategory').val(),
            order_id: $('#complaintOrderId').val(),
            message: $('#complaintMessage').val()
        };
        
        $.ajax({
            url: 'api/complaints.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#complaintFormCard').hide();
                    $('.complaint-info-card').hide();
                    $('#complaintSuccess').show();
                } else {
                    alert(response.message || 'Gagal mengirim komplain.');
                    submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Kirim Komplain');
                }
            },
            error: function() {
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Kirim Komplain');
            }
        });
    });
});
