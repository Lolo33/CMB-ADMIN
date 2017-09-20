<div class="box contour-gris grand" id="nav-tool" style="margin: 40px 0 70px;">
    <h1 class="titre-box">Navigation</h1>

    <div class="list-group">
        <a href="complexe_accueil?complexe=<?php echo $idComplexe; ?>" class="list-group-item <?php activeMenuIfContain("complexe_accueil"); ?>">
            Le Complexe
        </a>
        <a href="complexe_echanges?complexe=<?php echo $idComplexe; ?>" class="list-group-item <?php activeMenuIfContain("complexe_echanges"); ?>">
            Echanges
        </a>
        <a href="complexe_historique?complexe=<?php echo $idComplexe; ?>" class="list-group-item <?php activeMenuIfContain("complexe_historique"); ?>">
            Historique
        </a>
        <a href="complexe_taches?complexe=<?php echo $idComplexe; ?>" class="list-group-item <?php activeMenuIfContain("complexe_taches"); ?>">
            Tâches
        </a>
        <a href="#" class="list-group-item disabled">
            Documents
        </a>
        <a href="#" class="list-group-item disabled">
            Réservations
        </a>
        <a href="#" class="list-group-item disabled">
            Plages horaires
        </a>
        <a href="#" class="list-group-item disabled">
            Tarifs
        </a>
        <a href="#" class="list-group-item disabled">
            Comissions
        </a>
    </div>

</div>
