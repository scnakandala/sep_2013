<div class="students form">
<?php echo $this->Form->create('Student');?>
	<fieldset>
		<legend><?php echo __('Edit Student'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('index_number');
		echo $this->Form->input('name');
		echo $this->Form->input('gmail_address');
		echo $this->Form->input('mid_marks');
		echo $this->Form->input('InternalEvaluator');
		echo $this->Form->input('Technology');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Student.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Student.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
	</ul>
</div>
