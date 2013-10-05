<div class="timeslots view">
<h2><?php  echo __('Timeslot');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeslot['Timeslot']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timeslot['Timeslot']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Timeslot'), array('action' => 'edit', $timeslot['Timeslot']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timeslot'), array('action' => 'delete', $timeslot['Timeslot']['id']), null, __('Are you sure you want to delete # %s?', $timeslot['Timeslot']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List External Evaluators'), array('controller' => 'external_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New External Evaluator'), array('controller' => 'external_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related External Evaluators');?></h3>
	<?php if (!empty($timeslot['ExternalEvaluator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($timeslot['ExternalEvaluator'] as $externalEvaluator): ?>
		<tr>
			<td><?php echo $externalEvaluator['id'];?></td>
			<td><?php echo $externalEvaluator['name'];?></td>
			<td><?php echo $externalEvaluator['gmail_address'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'external_evaluators', 'action' => 'view', $externalEvaluator['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'external_evaluators', 'action' => 'edit', $externalEvaluator['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'external_evaluators', 'action' => 'delete', $externalEvaluator['id']), null, __('Are you sure you want to delete # %s?', $externalEvaluator['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New External Evaluator'), array('controller' => 'external_evaluators', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Internal Evaluators');?></h3>
	<?php if (!empty($timeslot['InternalEvaluator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($timeslot['InternalEvaluator'] as $internalEvaluator): ?>
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
