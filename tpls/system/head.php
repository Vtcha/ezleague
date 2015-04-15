<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $site_settings['name']; ?> - Create, Manage, Game</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css?v2" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="default" href="assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/custom.css?v4" rel="stylesheet" type="text/css"/>
<!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" /> -->
<link rel="stylesheet" href="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" />
<!-- END THEME STYLES -->
<?php if( $site_settings['fav_icon'] != '' ) { ?>
<link rel="shortcut icon" href="logos/<?php echo $site_settings['fav_icon']; ?> "/>
<?php } else { ?>
<link rel="shortcut icon" href="assets/admin/layout/img/logos/waf3r/ezl_icon.png?v2"/>
<?php } ?>
</head>
<!-- END HEAD -->