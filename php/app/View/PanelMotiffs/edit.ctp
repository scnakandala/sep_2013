<div class="panelMotiffs form">
<?php echo $this->Form->create('PanelMotiff');?>
	<fieldset>
		<legend><?php echo __('Edit Panel Motiff'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PanelMotiff.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PanelMotiff.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Panel Motiffs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
