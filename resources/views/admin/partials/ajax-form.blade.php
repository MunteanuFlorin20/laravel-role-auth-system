<script>
    $(document).on('submit', '.dev-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),

            success: function() {
                const modalEl = document.getElementById('modal-window');
                const modal = bootstrap.Modal.getInstance(modalEl);

                if (modal) {
                    modal.hide();
                }

                modalEl.addEventListener('hidden.bs.modal', function() {
                    location.reload();
                }, {
                    once: true
                });
            },

            error: function() {
                showToast("Eroare la salvare!", "error");
            }
        });
    });
</script>
