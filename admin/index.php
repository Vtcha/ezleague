<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <?php include('tpls/home/registration-users.php'); ?>
					<?php include('tpls/home/registration-teams.php'); ?>
                </div>
                <div class="col-lg-4">
                    <?php include('tpls/home/site-totals.php'); ?>
                </div>
            </div>
        </div>
        
     </div> <!-- /end header id=wrapper -->
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

</body>

</html>
