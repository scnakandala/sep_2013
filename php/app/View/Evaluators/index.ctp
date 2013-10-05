<div class="evaluators index">
	<h2><?php echo __('Evaluators');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('gmail_address');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($evaluators as $evaluator): ?>
	<tr>
		<td><?php echo h($evaluator['Evaluator']['name']); ?>&nbsp;</td>
		<td><?php echo h($evaluator['Evaluator']['gmail_address']); ?>&nbsp;</td>
		<td><?php echo h($evaluator['Evaluator']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evaluator['Evaluator']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evaluator['Evaluator']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evaluator['Evaluator']['id']), null, __('Are you sure you want to delete # %s?', $evaluator['Evaluator']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Evaluator'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
