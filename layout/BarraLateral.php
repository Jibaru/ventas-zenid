<nav id="barra-lateral" class="shadow-sm overflow-auto">
    <style>
    #barra-lateral {
        height: 100%;
        background-color: #f1f1f1;
    }

    #barra-lateral>ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    #barra-lateral>ul>li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Change the link color on hover */
    #barra-lateral ul li a:hover {
        background-color: #555;
        color: white;
    }
    </style>
    <ul>
        <?php
            foreach ($_SESSION["autenticado"]["privilegios"] as $privilegio) {
        ?>
        <li>
            <a href="<?php echo $privilegio["path"]?>">
                <span><?php echo $privilegio["nombre"]?></span>
                <?php echo $privilegio["icono"]?>
            </a>

        </li>
        <?php } ?>

    </ul>
</nav>