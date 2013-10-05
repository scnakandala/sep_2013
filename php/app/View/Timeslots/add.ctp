<div class="timeslots form">
<?php echo $this->Form->create('Timeslot');?>
	<fieldset>
		<legend><?php echo __('Add Timeslot'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('ExternalEvaluator');
		echo $this->Form->input('InternalEvaluator');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Timeslots'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List External Evaluators'), array('controller' => 'external_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New External Evaluator'), array('controller' => 'external_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
