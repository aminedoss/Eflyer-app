<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a href="../index.php">
      <i class="fa-solid fa-house fa-xl" style="color: #000000;"></i>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    </div>
    <ul class="navbar-nav ms-auto">
        <li>
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user fa-xl m-2">  </i><?= $_SESSION['auth_user']['name'];?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="../logout.php">
                <i class="fa-solid fa-right-from-bracket fa-xl m-2"></i>LogOut
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#"> <i class="fa-solid fa-gear fa-xl m-2"></i> Setting </a>
            </li>
          </ul>
        </li>
      </ul>
  </div>
</nav>