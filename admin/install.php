<?php
include('./lib/class-db.php');
include('./lib/class-ezadmin.php');
$ez = new ezAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ezLeague v3.0 - PHP Online Gaming League Script</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/ezleague.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ezLeague <em>Installation</em></h3> 
                    </div>
                    <div class="panel-body">
                      <small>Edit your MySQL &amp; Site URL values in: <em>/lib/class-db.php</em>, otherwise the installation will fail.</small>
                        <form role="form" id="ezLeagueInstallation" method="POST">
                            <fieldset>
                            	<div class="form-group">
                                  <label>Site Name</label>
                                    <input class="form-control" id="site_name" name="site_name" type="text">
                                </div>
                                <div class="form-group">
                                  <label>URL to <em>ezLeague</em> Installation<br/> <small>(ex: http://www.mdloring.com/ezleague)</small></label>
                                    <input disabled class="form-control" id="site_url" name="site_url" type="text" value="<?php echo $ez->site_url; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Database Name</label>
                                    <input disabled class="form-control" id="database" name="database" type="text" value="<?php echo $ez->database; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Table Prefix</label>
                                    <input disabled class="form-control" id="prefix" name="prefix" type="text" value="<?php echo $ez->prefix; ?>">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Run Installer</button>
                                <div class="success">
				                  <span class="success_text"></span>
				                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core Scripts - Include with every page -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="js/ezleague.js"></script>
</body>
</html>
