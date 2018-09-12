<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>La réservation a bien été accepté</h2>
        </div>
        <div class="modal-body">
            <p>La réservation est maintenant accepté. Le calendrier a lui aussi été modifié.</p>
            <p>Un email de confirmation a été envoyé au client.</p>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('myModal');
    const span = document.getElementsByClassName("close")[0];

    span.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>document.getElementById('myModal').style.display = 'block';
    openMenu(event,'Reservations1')</script>