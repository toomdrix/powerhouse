<div class="col-sm-4">
<?php echo Form::open(array('action' => 'Powerhouse\Core\DoorstepController@postLogin', 'class'=>'form-signup')); ?>
    <div class="form-group">
		<?php echo Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')); ?>
	</div>
	<div class="form-group">
		<?php echo Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')); ?>
	</div>
	<div class="form-group">
		<?php echo Form::submit('Let me in', array('class'=>'btn btn-large btn-primary btn-block')); ?>
	</div>
<?php echo Form::close(); ?>
</div>