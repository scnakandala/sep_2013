<div class="internalEvaluators view">
<h2><?php  echo __('Internal Evaluator');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($internalEvaluator['InternalEvaluator']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($internalEvaluator['InternalEvaluator']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gmail Address'); ?></dt>
		<dd>
			<?php echo h($internalEvaluator['InternalEvaluator']['gmail_address']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Internal Evaluator'), array('action' => 'edit', $internalEvaluator['InternalEvaluator']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Internal Evaluator'), array('action' => 'delete', $internalEvaluator['InternalEvaluator']['id']), null, __('Are you sure you want to delete # %s?', $internalEvaluator['InternalEvaluator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Timeslots');?></h3>
	<?php if (!empty($internalEvaluator['Timeslot'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($internalEvaluator['Timeslot'] as $timeslot): ?>
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
<div class="related">
	<h3><?php echo __('Related Students');?></h3>
	<?php if (!empty($internalEvaluator['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Index Number'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th><?php echo __('Mid Marks'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($internalEvaluator['Student'] as $student): ?>
		<tr>
			<td><?php echo $student['id'];?></td>
			<td><?php echo $student['index_number'];?></td>
			<td><?php echo $student['name'];?></td>
			<td><?php echo $student['gmail_address'];?></td>
			<td><?php echo $student['mid_marks'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'students', 'action' => 'view', $student['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'students', 'action' => 'edit', $student['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'students', 'action' => 'delete', $student['id']), null, __('Are you sure you want to delete # %s?', $student['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
