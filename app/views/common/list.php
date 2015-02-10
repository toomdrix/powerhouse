<?php $module_url = strtolower(PWR::getTypeFromCollection($items)); ?>
<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Actions</a>
	</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<li><a data-toggle="modal" href="/<?php echo $module_url.'/create'; ?>" data-target="#new-item-modal"><span class="glyphicon glyphicon-star-empty"></span> Add New</a></li>
		</ul>
	</div>
</nav>

<?php if (count($items)): ?>
<div class="table-responsive">
	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr>
				<?php foreach($items[0]->getPrimaryInfo() as $key=>$val): ?>
					<th width="<?php echo 100/count($items[0]->getPrimaryInfo()); ?>%"><?= $key ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($items as $item): ?>
			<tr>
				<?php foreach ($item->getPrimaryInfo() as $key => $arr): ?>
					<td>
						<?php if (isset($arr['link']) && $arr['link']): ?>
							<a <?php if (isset($arr['modal']) && $arr['modal']): ?>data-toggle="modal" data-target="#new-item-modal" <?php endif; ?> href="<?php echo $arr['link'] ?>">
								<?php echo $arr['text']; ?>
							</a>
						<?php else: ?>
							<?php echo $arr['text']; ?>
						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php if (method_exists($items, 'links')): ?> 
	<?php echo $items->links(); ?>
<?php endif; ?> 
<?php else: ?>
	<p>There is nothing to see here...</p>
<?php endif; ?>