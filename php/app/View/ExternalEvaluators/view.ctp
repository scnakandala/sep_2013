<div class="externalEvaluators view">
<h2><?php  echo __('External Evaluator');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($externalEvaluator['ExternalEvaluator']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($externalEvaluator['ExternalEvaluator']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gmail Address'); ?></dt>
		<dd>
			<?php echo h($externalEvaluator['ExternalEvaluator']['gmail_address']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit External Evaluator'), array('action' => 'edit', $externalEvaluator['ExternalEvaluator']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete External Evaluator'), array('action' => 'delete', $externalEvaluator['ExternalEvaluator']['id']), null, __('Are you sure you want to delete # %s?', $externalEvaluator['ExternalEvaluator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List External Evaluators'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New External Evaluator'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Technologies');?></h3>
	<?php if (!empty($externalEvaluator['Technology'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($externalEvaluator['Technology'] as $technology): ?>
		<tr>
			<td><?php echo $technology['id'];?></td>
			<td><?php echo $technology['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'technologies', 'action' => 'view', $technology['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'technologies', 'action' => 'edit', $technology['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'technologies', 'action' => 'delete', $technology['id']), null, __('Are you sure you want to delete # %s?', $technology['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Timeslots');?></h3>
	<?php if (!empty($externalEvaluator['Timeslot'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($externalEvaluator['Timeslot'] as $timeslot): ?>
		<tr>
			<td><?php echo $timeslot['id'];?></td>
			<td><?php echo $timeslot['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timeslots', 'action' => 'view', $timeslot['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'timeslots', 'action' => 'edit', $timeslot['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'timeslots', 'action' => 'delete', $timeslot['id']), null, __('Are you sure you want to delete # %s?', $timeslot['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
