<div class="panelMotiffs view">
<h2><?php  echo __('Panel Motiff');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($panelMotiff['PanelMotiff']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($panelMotiff['PanelMotiff']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remaining Vancancies'); ?></dt>
		<dd>
			<?php echo h($panelMotiff['PanelMotiff']['remaining_vancancies']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Panel Motiff'), array('action' => 'edit', $panelMotiff['PanelMotiff']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Panel Motiff'), array('action' => 'delete', $panelMotiff['PanelMotiff']['id']), null, __('Are you sure you want to delete # %s?', $panelMotiff['PanelMotiff']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Panel Motiffs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Panel Motiff'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Internal Evaluators');?></h3>
	<?php if (!empty($panelMotiff['InternalEvaluator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($panelMotiff['InternalEvaluator'] as $internalEvaluator): ?>
		<tr>
			<td><?php echo $internalEvaluator['id'];?></td>
			<td><?php echo $internalEvaluator['name'];?></td>
			<td><?php echo $internalEvaluator['gmail_address'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'internal_evaluators', 'action' => 'view', $internalEvaluator['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'internal_evaluators', 'action' => 'edit', $internalEvaluator['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'internal_evaluators', 'action' => 'delete', $internalEvaluator['id']), null, __('Are you sure you want to delete # %s?', $internalEvaluator['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
