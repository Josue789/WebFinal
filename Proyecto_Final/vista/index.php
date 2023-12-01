<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/MainCoach.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"   >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
  <header class="text-bg-danger">
    <nav class="navbar bg-body-tertiary w-100 h-100 text-bg-primary">
      <div class="container-fluid w-100">
        <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </nav>
  </header>
  <div class="container-fluid scroller">
    <div class="container overflow-hidden text-center">
      <div class="row gx-5">
        <div class="col">
           <div class="p-3 text-start display-5">Coach: </div>
        </div>
        <div class="col">
          <div class="p-3 display-5">Codign cup 2023</div>
        </div>
      </div>
    </div>
    <div class="container mb-3">
      <table class="table table-info">
        <thead>
          <tr>
            <th scope="col">Equipo</th>
            <th scope="col">Institucion</th>
            <th scope="col">Concurso</th>
            <th scope="col">Estatus</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
      </table>
      <div class="row justify-content-between">
        <div class="col-6">
          <a href="login.php" class=" btn btn-outline-danger" type="button">Cerrar sesión</a> 
        </div>
        <div class="col-2  ">
          <a class=" btn btn-primary" type="submit" href="./RegistroEquipo.php">Nuevo equipo</a>
        </div>        
      </div>      
    </div>   
  </div>
  <footer id="sticky-footer" class="flex-shrink-0 py-1 text-white-50 MenuInf">
    <div class="container text-center">
      <div class="row">
        <div class="col-4">
          <img src="img/omegaup.png" height="12%" alt="">
        </div>
        <div class="col-4">
          <img src="img/SSC-blueprism-2col-logo-cmyk-ai (1).png" height="12%" alt="">
        </div>
        <div class="col-4">
          <img src="img/Untitled.png" height="12%" alt="">
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>