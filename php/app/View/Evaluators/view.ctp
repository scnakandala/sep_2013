<div class="evaluators view">
<h2><?php  echo __('Evaluator');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($evaluator['Evaluator']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gmail Address'); ?></dt>
		<dd>
			<?php echo h($evaluator['Evaluator']['gmail_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($evaluator['Evaluator']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evaluator'), array('action' => 'edit', $evaluator['Evaluator']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evaluator'), array('action' => 'delete', $evaluator['Evaluator']['id']), null, __('Are you sure you want to delete # %s?', $evaluator['Evaluator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evaluators'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evaluator'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeslots'), array('controller' => 'timeslots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeslot'), array('controller' => 'timeslots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Technologies');?></h3>
	<?php if (!empty($evaluator['Technology'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Technology'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($evaluator['Technology'] as $technology): ?>
		<tr>
			<td><?php echo $technology['technology'];?></td>
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
	<?php if (!empty($evaluator['Timeslot'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Timeslot'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($evaluator['Timeslot'] as $timeslot): ?>
		<tr>
			<td><?php echo $timeslot['timeslot'];?></td>
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
	<?php if (!empty($evaluator['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Index Number'); ?></th>
		<th><?php echo __('Name With Initials'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th><?php echo __('Mid Marks'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($evaluator['Student'] as $student): ?>
		<tr>
			<td><?php echo $student['index_number'];?></td>
			<td><?php echo $student['name_with_initials'];?></td>
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
