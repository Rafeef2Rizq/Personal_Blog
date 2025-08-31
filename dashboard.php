<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}

?>
  <?php include 'components/head.php' ?>

<body>
    <!-- Sidebar -->
  <?php include 'components/slidebar.php' ?>

    <!-- Main Content -->
   
 <div id="content">
       <?php include 'components/topbar.php' ?>


        <!-- Main Content Area -->
        <div class="container-fluid px-lg-4">

            <div class="py-4">
                <h5 class="mb-0">Hello World, Welcome!</h5>
                <p class="mb-0 text-muted d-none d-md-block">Show your day very happy with us.</p>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card d-flex">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-uppercase mb-2">TOTAL Earnings</p>
                                <h3 class="display-6 fw-normal">$9,800</h3>
                                <h6 class="change text-success fs-4">+63%</h6>
                                <a href="#" class="">Net earning <span><iconify-icon icon="mdi-light:arrow-right"
                                            width="24" height="24"
                                            style="vertical-align: top;"></iconify-icon></span></a>
                            </div>
                            <div class="p-4" style="background-color: #EEF3E9;">
                                <iconify-icon icon="mdi:dollar" class="text-success" width="35"
                                    height="35"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card d-flex">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-uppercase mb-2">orders</p>
                                <h3 class="display-6 fw-normal">$22,500</h3>
                                <h6 class="change text-danger fs-4">-44%</h6>
                                <a href="#" class="">View all orders <span><iconify-icon icon="mdi-light:arrow-right"
                                            width="24" height="24" style="vertical-align: top;"></iconify-icon></span>
                                </a>
                            </div>
                            <div class="p-4" style="background-color: #DBF0F4;">
                                <iconify-icon icon="mdi:cart-outline" class="text-info" width="35"
                                    height="35"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card d-flex">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-uppercase mb-2">customers</p>
                                <h3 class="display-6 fw-normal">$12,240</h3>
                                <h6 class="change text-success fs-4">+57%</h6>
                                <a href="#" class="">View Customers <span><iconify-icon icon="mdi-light:arrow-right"
                                            width="24" height="24"
                                            style="vertical-align: top;"></iconify-icon></span></a>
                            </div>
                            <div class="p-4" style="background-color: #F9F5EE;">
                                <iconify-icon icon="material-symbols:person-outline" class="text-warning" width="35"
                                    height="35"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card d-flex">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-uppercase mb-2">Balance</p>
                                <h3 class="display-6 fw-normal">$10,640</h3>
                                <h6 class="change text-black-50 fs-4">0%</h6>
                                <a href="#" class="">Withdraw <span><iconify-icon icon="mdi-light:arrow-right"
                                            width="24" height="24"
                                            style="vertical-align: top;"></iconify-icon></span></a>
                            </div>
                            <div class="p-4" style="background-color: #E1F0FA;">
                                <iconify-icon icon="iconoir:wallet" class="text-info" width="35"
                                    height="35"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

            <!-- Sales By Location, Age & Gender -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="height: 400px;">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0">Sales By Location</h5>
                            <button class="btn btn-sm btn-light ">
                                Export report
                            </button>
                        </div>
                        <div class="card-body mb-4">
                            <div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="mb-2">USA</p>
                                    <p class="mb-2">70%</p>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-label="USA" style="width: 70%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="mb-2">United Kingdom</p>
                                    <p class="mb-2">30%</p>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-label="USA" style="width: 30%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="mb-2">Australia</p>
                                    <p class="mb-2">65%</p>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-label="USA" style="width: 65%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="mb-2">India</p>
                                    <p class="mb-2">55%</p>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-label="USA" style="width: 55%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="mb-2">Others</p>
                                    <p class="mb-2">10%</p>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-label="USA" style="width: 10%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="height: 400px;">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0">Sales By Age</h5>
                            <button class="btn btn-sm btn-light ">
                                Export report
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="chart-container mt-3" style="height: 260px;">
                                <canvas id="ageChart"></canvas>
                            </div>
                            <!-- <div class="chart-container">
                  <canvas id="ageChart"></canvas>
                </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="height: 400px;">
                        <div class="card-header">
                            <h5 class="mb-0">Sales By Gender</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container  mt-3" style="height: 260px;">
                                <canvas id="genderChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        

         

        </div>

        <!-- Footer -->
        <footer class="container-fluid bg-white ">
            <footer class="row align-items-center py-4">
                <div class="col-md-6 ">
                    <p class="m-0">© DashLite - Admin Dashboard </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="m-0" class="">HTML Website Template By :<a href="https://templatesjungle.com/"
                            class="text-decoration-underline" target="_blank">TemplatesJungle</a></p>
                </div>
            </footer>
        </footer>
    </div>

  <?php include 'components/script.php' ?>


</body>

</html>