<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="../home.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- podrías poner un logo aquí -->
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">UNIANDES</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="../home.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Menú principal -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Menú principal</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="../organizador/organizador.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Organizadores'; ?>
                        <div data-i18n="Without navbar">Organizadores</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="../participante/participante.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Participantes'; ?>
                        <div data-i18n="Container">Participantes</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="../actividad/actividad.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Actividades'; ?>
                        <div data-i18n="Fluid">Actividades</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="../act_participante/act_participante.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Actividad - Participante'; ?>
                        <div data-i18n="Blank">Actividad - Participante</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
