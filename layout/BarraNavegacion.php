<nav id="menu" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="principal">
            Zenid
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link active">
                        <?php echo $_SESSION["autenticado"]["usuario"]["nombre"] ?>
                    </span>

                </li>
                <li class="nav-item">
                    <span class="nav-link active bg-light text-dark">
                        <?php echo $_SESSION["autenticado"]["rol"]["nombre"] ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar-sesion">
                        Cerrar Sesión <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>