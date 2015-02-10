<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new company...</h4>
</div>
<?php echo Form::model(isset($company) ? $company : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('name', 'Name'); ?>
			<?php echo Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Enter name')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('phone', 'Telephone'); ?>
			<?php echo Form::text('phone', null, array('class'=>'form-control', 'placeholder'=>'Enter phone number')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('email', 'Email Address'); ?>
			<?php echo Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Enter email address')); ?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($company)): ?>
			<?php echo Form::hidden('id', $company->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php endif; ?>
	</div>
<?php echo Form::close(); ?>