<!DOCTYPE html>
<html lang="es" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="./public/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Sistema Cultural - UNIANDES</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="./public/images/logo.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="./public/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="./public/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="./public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="./public/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="./public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="./public/assets/vendor/css/pages/page-auth.css" />

  <!-- Helpers -->
  <script src="./public/assets/vendor/js/helpers.js"></script>
  <script src="./public/assets/js/config.js"></script>
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Card -->
        <div class="card">
          <div class="card-body" style="text-align: center;">
            <!-- Logo / Título -->
            <div class="app-brand justify-content-center mb-3">
              <h1>Sistema Cultural<br><small>UNIANDES</small></h1>
            </div>

            <p class="mb-3">Seleccione un módulo para gestionar la información:</p>

            <div class="d-grid gap-2">
              <a href="./views/organizador/organizador.views.php" class="btn btn-primary">
                Organizadores
                </a>

                <a href="./views/participante/participante.views.php" class="btn btn-secondary">
                Participantes
                </a>

                <a href="./views/actividad/actividad.views.php" class="btn btn-info">
                Actividades
                </a>

                <a href="./views/act_participante/act_participante.views.php" class="btn btn-warning">
                Actividad - Participante
                </a>
            </div>

          </div>
        </div>
        <!-- /Card -->
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <script src="./public/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="./public/assets/vendor/libs/popper/popper.js"></script>
  <script src="./public/assets/vendor/js/bootstrap.js"></script>
  <script src="./public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="./public/assets/vendor/js/menu.js"></script>

  <!-- Main JS -->
  <script src="./public/assets/js/main.js"></script>
</body>

</html>
