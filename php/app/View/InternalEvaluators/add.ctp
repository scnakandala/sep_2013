<div class="internalEvaluators form">
<?php echo $this->Form->create('InternalEvaluator');?>
	<fieldset>
		<legend><?php echo __('Add Internal Evaluator'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('gmail_address');
		echo $this->Form->input('Timeslot');
		echo $this->Form->input('Student');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
