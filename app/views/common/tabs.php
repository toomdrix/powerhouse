<ul class="nav nav-tabs" id="myTab">
<?php
$i = 1;
foreach ($tabs as $name => $tab): ?>
	<li <?php if ($i++ == 1): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#<?php echo str_replace(" ", "_", $name); ?>"><?php echo ucwords($name); ?></a></li>
<?php endforeach; ?>
</ul>

<div class="tab-content" id="myTabContent">
<?php
$i = 1;
foreach ($tabs as $name => $tab): ?>
	<div id="<?php echo str_replace(" ", "_", $name); ?>" class="tab-pane fade in <?php if ($i++ == 1): ?>active<?php endif; ?>">
		<?php echo $tab ?>
	</div>
<?php endforeach; ?>
</div>