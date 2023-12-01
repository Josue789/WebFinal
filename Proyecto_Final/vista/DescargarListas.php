<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="css/Registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
  <header class="">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand display-6" href="#" >
            <img src="img/CCUP.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Coding cup
          </a>
          <a  class="navbar-brand display-5" href="#" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><span class="material-symbols-outlined">
            menu
            </span></a>
        </div>
      </nav>
  </header>

    <div class="container d-flex justify-content-center">
      <div class="container-lg ">
       
        <div class="container mb-3">
          <label class="display-3">Descargar listas</label>
          
          <div class="form-check display-6 mt-2 ">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Lista de equipos
            </label>
          </div>

          <div class="form-check display-6 mt-2 ">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Lista de coaches
            </label>
          </div>

          <div class="form-check display-6 mt-2 ">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Lista de concursos
            </label>
          </div>
          
          <div class="form-check display-6 mt-2 ">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Lista administradores y auxiliares
            </label>
          </div>
          

          <div class="row justify-content-between mt-3">

                <a class=" btn btn-primary" type="submit" href="#">Descargar <span class="material-symbols-outlined">
                    download
                </span></a>              
          </div>      
      </div>   

    </div>

        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Menu administrador</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div>
                <nav class="nav flex-column nav-underline">
                  <a class="nav-link "  href="IndexAdmin.php">Usuarios</a>
                  <a class="nav-link" href="concursos.php">Concursos</a>
                  <a class="nav-link active" aria-current="page" href="#">Descargar listas</a>
                  <a class="btn btn-danger" href="login.php" >Cerrar sesion</a>
                </nav>
              </div>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>