<?php
$nav = array(
		array('Overview','dashboard'),
		array('My Projects','project'),
		array('My Staff','user'),
		array('Profile','company')
	);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Powerhouse Housing</title>
	<link href="/assets/css/style.css" rel="stylesheet"/>
	<link href="/assets/css/datepicker.css" rel="stylesheet"/>
	<script type="text/javascript" src="/assets/src/js/libs/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="/assets/src/js/libs/bootstrap.js"></script>
	<script type="text/javascript" src="/assets/src/js/libs/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/assets/src/js/Site.js?cache=1"></script>
	<script type="text/javascript" src="/assets/src/js/libs/Chart.js"></script>
	<script type="text/javascript" src="/assets/src/js/libs/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="/assets/src/js/Modules/ChartSet.js"></script>
	<script type="text/javascript" src="/assets/src/js/Modules/LineChart.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,700,600,800,900,200,100' rel='stylesheet' type='text/css'>
</head>
<body>
	<nav role="navigation" class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button data-target="#bs-example-navbar-collapse-9" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="bs-example-navbar-collapse-9" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php foreach ($nav as $item): ?>
						<li <?php if(PWR::getModuleName() == $item[1]): ?> class="active" <?php endif; ?> ><a href="/<?php echo $item[1] ?>"><?php echo $item[0] ?></a></li>
					<?php endforeach; ?> 
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="page-header">
		<div class="col-sm-8">
			<h1 class="navbar-left"><?php echo isset($title) ? $title : ucwords(strstr(Route::currentRouteName(),'.', true)); ?></h1>
		</div>
		<div class="col-sm-4">
			<input type="text" placeholder="Search: NOT IMPLEMENTED" class="form-control navbar-inverse" />
			<button type="submit" name="search"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
	
	<div class="wrapper">

		<?php if (isset($sidebar)): ?>
		<div id="sidebar" class="col-md-2">
	
			<?php echo $sidebar;  ?>

		</div>
		<div id="main" class="col-md-10">
		<?php else: ?>
		<div id="main" class="col-md-12">
		<?php endif;?>

			<?php if ($errors->has()): ?>
				<?php foreach ($errors->all() as $message): ?>
					<div class="alert alert-danger"><?php echo $message; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ($warnings = Session::get('warning')): ?>
				<?php foreach ($warnings as $message): ?>
					<div class="alert alert-warning"><?php echo $message; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ($success = Session::get('success')): ?>
				<?php foreach ($success as $message): ?>
					<div class="alert alert-success"><?php echo $message; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php echo $content; ?>

		</div>
		<div class="modal fade" id="new-item-modal">
			<div class="modal-dialog">
				<div class="modal-content">
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</body>
</html>
