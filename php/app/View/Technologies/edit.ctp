<div class="technologies form">
<?php echo $this->Form->create('Technology');?>
	<fieldset>
		<legend><?php echo __('Edit Technology'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('ExternalEvaluator');
		echo $this->Form->input('Student');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Technology.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Technology.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List External Evaluators'), array('controller' => 'external_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New External Evaluator'), array('controller' => 'external_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
