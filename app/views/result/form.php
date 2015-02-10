<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new result...</h4>
</div>
<?php echo Form::model(isset($result) ? $result->getOriginal() : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('quarter', 'Quarter'); ?>
			<?php echo Form::select('quarter',array(1=>1,2=>2,3=>3,4=>4), isset($result) ? $result->quarter : null, array('class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('year', 'Year'); ?>
			<?php echo Form::text('year', null, array('class'=>'form-control', 'placeholder'=>'Enter year')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('estimated', 'Estimated Cost'); ?>
			<?php echo Form::text('estimated', null, array('class'=>'form-control', 'placeholder'=>'Enter estimated cost')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('actual', 'Actual Cost'); ?>
			<?php echo Form::text('actual', null, array('class'=>'form-control', 'placeholder'=>'Enter actual cost')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('project', 'Project'); ?>
			<?php echo Form::select('project_id', $projects, isset($result) ? $result->project_id : null, array('class'=>'form-control')); ?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($result)): ?>
			<?php echo Form::hidden('id', $result->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php endif; ?>
	</div>
<?php echo Form::close(); ?>