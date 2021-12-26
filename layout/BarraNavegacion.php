<nav id="menu" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            Zenid
        </a>
        <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link active">
                        <?php echo $_SESSION["autenticado"]["usuario"]["nombre"] ?>
                        <?php echo $_SESSION["autenticado"]["usuario"]["ape_paterno"] ?>
                        <?php echo $_SESSION["autenticado"]["usuario"]["ape_materno"] ?>
                    </span>

                </li>
                <li class="nav-item">
                    <span class="nav-link active bg-light text-dark">
                        <?php echo $_SESSION["autenticado"]["rol"]["nombre"] ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../ModuloAutenticacion/PostCerrarSesion.php">
                        Cerrar Sesión <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>