<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new user...</h4>
</div>
<?php echo Form::model(isset($user) ? $user : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('firstname', 'First Name'); ?>
			<?php echo Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'Enter first name')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('lastname', 'Last Name'); ?>
			<?php echo Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Enter last name')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('company', 'Client'); ?>
			<?php echo Form::select('company_id', $clients, isset($user) ? $user->company_id : null, array('class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('email', 'Email Address'); ?>
			<?php echo Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Enter email address')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('password', 'Password'); ?>
			<?php echo Form::password('password', array('class'=>'form-control', 'placeholder'=>'Enter password')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('usergroup', 'Group'); ?>
			<?php echo Form::select('usergroup_id', $usergroups, isset($user) ? $user->usergroup_id : null, array('class'=>'form-control')); ?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($user)): ?>
			<?php echo Form::hidden('id', $user->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php endif; ?>
	</div>
<?php echo Form::close(); ?>