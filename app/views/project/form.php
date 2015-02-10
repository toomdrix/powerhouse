<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new project...</h4>
</div>
<?php echo Form::model(isset($project) ? $project : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('name', 'Name'); ?>
			<?php echo Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Enter project name')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('company', 'Client'); ?>
			<?php echo Form::select('company_id', $clients, isset($project) ? $project->company_id : null, array('class'=>'form-control')); ?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($project)): ?>
			<?php echo Form::hidden('id', $project->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php endif; ?>
	</div>
<?php echo Form::close(); ?>