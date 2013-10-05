<div class="evaluators form">
<?php echo $this->Form->create('Evaluator');?>
	<fieldset>
		<legend><?php echo __('Edit Evaluator'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('gmail_address');
		echo $this->Form->input('type');
		echo $this->Form->input('Technology');
		echo $this->Form->input('Timeslot');
		echo $this->Form->input('Student');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Evaluator.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Evaluator.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Evaluators'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
