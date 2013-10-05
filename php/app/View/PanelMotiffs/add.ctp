<div class="panelMotiffs form">
<?php echo $this->Form->create('PanelMotiff');?>
	<fieldset>
		<legend><?php echo __('Add Panel Motiff'); ?></legend>
	<?php
		echo $this->Form->input('category');
		echo $this->Form->input('remaining_vancancies');
		echo $this->Form->input('InternalEvaluator');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Panel Motiffs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
