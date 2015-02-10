<?php $id = time().rand(); ?>

<?php if ($title = $chart->getTitle()): ?> 
	<h3><?php echo $title; ?></h3>
<?php endif; ?> 

<div class="chart-wrapper">
	<canvas class="chart"
	id="line<?php echo $id; ?>"
	data-ref="<?php echo $id; ?>"
	data-type="Line"
	data-labels="<?php echo htmlentities(json_encode($chart->getLabels())) ?>"
	data-sets="<?php echo htmlentities(json_encode($chart->getDataSets())) ?>"
	></canvas>
</div>