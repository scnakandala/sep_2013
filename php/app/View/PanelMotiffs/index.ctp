<div class="panelMotiffs index">
	<h2><?php echo __('Panel Motiffs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('category');?></th>
			<th><?php echo $this->Paginator->sort('remaining_vancancies');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($panelMotiffs as $panelMotiff): ?>
	<tr>
		<td><?php echo h($panelMotiff['PanelMotiff']['id']); ?>&nbsp;</td>
		<td><?php echo h($panelMotiff['PanelMotiff']['category']); ?>&nbsp;</td>
		<td><?php echo h($panelMotiff['PanelMotiff']['remaining_vancancies']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $panelMotiff['PanelMotiff']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $panelMotiff['PanelMotiff']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $panelMotiff['PanelMotiff']['id']), null, __('Are you sure you want to delete # %s?', $panelMotiff['PanelMotiff']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Panel Motiff'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
