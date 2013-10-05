<div class="externalEvaluators form">
<?php echo $this->Form->create('ExternalEvaluator');?>
	<fieldset>
		<legend><?php echo __('Add External Evaluator'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('gmail_address');
		echo $this->Form->input('Technology');
		echo $this->Form->input('Timeslot');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List External Evaluators'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
	</ul>
</div>
