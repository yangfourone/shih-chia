<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: black;">
  <a class="navbar-brand fa fa-phone" href="homepage.php">&nbsp;&nbsp;世佳事務用品行 S-Super</a>
<!--  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">-->
<!--    <span class="navbar-toggler-icon"></span>-->
<!--  </button>-->
<!--  <div class="collapse navbar-collapse" id="navbarResponsive">-->
<!--    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">-->
<!--      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="HomePage">-->
<!--        <a class="nav-link" href="homepage.php">-->
<!--          <i class="fa fa-fw fa-windows"></i>-->
<!--          <span class="nav-link-text">世佳首頁</span>-->
<!--        </a>-->
<!--      </li>-->
<!--      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Client">-->
<!--        <a class="nav-link" href="ClientPage.php">-->
<!--          <i class="fa fa-fw fa-child"></i>-->
<!--          <span class="nav-link-text" id="test">客戶資料</span>-->
<!--        </a>-->
<!--      </li>-->
<!--      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manufacturers">-->
<!--        <a class="nav-link" href="ManufacturersPage.php">-->
<!--          <i class="fa fa-fw fa-bank"></i>-->
<!--          <span class="nav-link-text" id="test">廠商資料</span>-->
<!--        </a>-->
<!--      </li>-->
<!--      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="inStock">-->
<!--        <a class="nav-link" href="StockLogin.php">-->
<!--          <i class="fa fa-fw fa-bar-chart-o"></i>-->
<!--          <span class="nav-link-text" id="test">庫存資訊</span>-->
<!--        </a>-->
<!--      </li>-->
<!--      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="DealRecord">-->
<!--        <a class="nav-link" href="DealLogin.php">-->
<!--          <i class="fa fa-fw fa-bitcoin"></i>-->
<!--          <span class="nav-link-text" id="test">進銷存及交易紀錄</span>-->
<!--        </a>-->
<!--      </li>-->
<!--    </ul>-->
<!--    <ul class="navbar-nav sidenav-toggler">-->
<!--      <li class="nav-item">-->
<!--        <a class="nav-link text-center" id="sidenavToggler">-->
<!--          <i class="fa fa-fw fa-angle-left"></i>-->
<!--        </a>-->
<!--      </li>-->
<!--    </ul>-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="ClientPage.php"><i class="fa fa-fw fa-child"></i>客戶資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ManufacturersPage.php"><i class="fa fa-fw fa-bank"></i>廠商資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="StockLogin.php"><i class="fa fa-fw fa-bar-chart-o"></i>庫存資訊</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="DealLogin.php"><i class="fa fa-fw fa-bitcoin"></i>交易紀錄</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>登出</a>
        </li>
        <text style="margin: auto 0 auto 0; color:yellow; padding-left: 10px" id="login_msg">Hello! <?php echo $_SESSION['account'] ?></text>
    </ul>
<!--  </div>-->
</nav>