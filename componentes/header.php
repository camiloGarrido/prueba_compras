
<nav class="navbar navbar-expand-md bg-body-tertiary">
  <div class="container-fluid">
  <img src="img/enac.png" alt="Logo"  height="50" class="d-inline-block align-text-top">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo $active=="home"?"active":"" ?> " aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $active=="productos"?"active":"" ?> " aria-current="page" href="productos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $active=="categorias"?"active":"" ?> " aria-current="page" href="categorias.php">Categorias</a>
        </li>
      </ul>
    </div>
  </div>
</nav>