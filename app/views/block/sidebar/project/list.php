<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php $counter = 1; ?> 
<?php foreach ($clients as $client): ?>
	<?php $projects = $client->projects()->get(); ?> 
	<?php if (count($projects)) : ?> 
	<div class="panel panel-default">
		<div class="panel-heading" role="tab">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#project-sidebar<?php echo $counter ?>" aria-expanded="true" aria-controls="collapseOne">
					<span><?php echo $client->name;  ?></span>
					<span class="caret"></span>
					<span class="badge pull-right"><?php echo count($projects); ?> </span>
				</a>
			</h4>
		</div>
		<div id="project-sidebar<?php echo $counter++ ?>" class="panel-collapse collapse" role="tabpanel">
			<?php foreach($projects as $project): ?>
				<div class="panel-body">
					<a href="/project/<?php echo $project->id ?>"><?php echo $project->name ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?> 
<?php endforeach; ?>
</div> 