<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Votre calendrier de réservation a bien été modofié</h2>
        </div>
        <div class="modal-body">
            <p>Uniquement la réservabilité des jours sélectionnés ont été modifié.</p>
            <p>S'il y avez des prix entre ces dates, les prix n'ont pas été modifié.</p>
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

<script>document.getElementById('myModal').style.display = 'block';</script>