<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header2">
            <span class="close">&times;</span>
            <h2>Erreur</h2>
        </div>
        <div class="modal-body">
            <p>Le pseudo ou le mot de passe que vous avez entré n'est pas correct.</p>
            <p>Veuillez rééssayer avec une autre combinaison.</p>
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