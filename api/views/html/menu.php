<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="../home.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- aquí podrías poner un logo -->
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Peluquería Canina</span>
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
                    <a href="../dueno/dueno.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Dueños'; ?>
                        <div data-i18n="Duenos">Dueños</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="../perro/perro.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Perros'; ?>
                        <div data-i18n="Perros">Perros</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="../cita/cita.views.php" target="base" class="menu-link">
                        <?php $_SESSION['rutas'] = 'Citas'; ?>
                        <div data-i18n="Citas">Citas</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
