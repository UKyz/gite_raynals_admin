<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Vos services ont bien été mis à jour.</h2>
        </div>
        <div class="modal-body">
            <p>Vous venez de mettre à jour vos services facturables.</p>
            <p>Vos services sur le front ont aussi était mis à jour.</p>
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
    openMenu(event,'Services')</script>