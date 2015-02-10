<?php $size = 6;//12/count($charts); ?>
<div class="col-md-12">
<?php if (isset($clients)): ?> 
<div class="dropdown pull-right">
		<button class="btn btn-default dropdown-toggle " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			Filter
			<span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
		</button>
		<ul class="dropdown-menu drop-form" role="menu" aria-labelledby="dropdownMenu1">
			<?php foreach ($clients as $company):?>
				<li role="presentation"><a role="menuitem" data-company-id="<?php echo $company->id; ?>" class="active" tabindex="-1" href="#"><?php echo $company->name ?> </a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?> 
	<h3 ><?php echo $title ?></h3>
</div>
<div id="ajax-content-wrapper">
	<?php foreach ($charts as $chart): ?>
		<div class="col-md-<?php echo $size ?>">
			<?php echo $chart; ?> 
		</div>
	<?php endforeach; ?> 
</div>