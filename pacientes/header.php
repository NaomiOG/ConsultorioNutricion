
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../bootstrap.css">
  <style type="text/css">
    #home{
          background: url("../imagenes/iconos.png");
          background-position: -165px -41px;
          cursor:pointer;
          width: 30px;
          height: 20px;
      }
      #salir{
          background: url("../imagenes/iconos.png");
          background-position: -45px -140px;
          cursor:pointer;
          width: 25px;
          height: 20px;
      }
      body{
        font-family: Century Gothic;
        
      }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div style="display: inline-flex;">
     <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><img src="../imagenes/logo.png" width="150px"/></li>
      <li class="nav-item active">
        <a class="nav-link" href="home.php?E=1"  style="color: #11525D;"><img id="home" src="../imagenes/img_trans.png"/>Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="historial.php" style="color: #11525D;">Historial de citas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../login.php" style="color: #11525D; "><img id="salir" src="../imagenes/img_trans.png"/>Cerrar sesión</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0" style="margin-left: 630px;">
      <span style="font-family: Century Gothic; color: #1E92A5;"><b>Ariana Espinoza Espinoza</b></span>
    </div>
  </div>
</nav>



</body>
</html>



