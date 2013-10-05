<div class="students view">
<h2><?php  echo __('Student');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($student['Student']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Index Number'); ?></dt>
		<dd>
			<?php echo h($student['Student']['index_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gmail Address'); ?></dt>
		<dd>
			<?php echo h($student['Student']['gmail_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mid Marks'); ?></dt>
		<dd>
			<?php echo h($student['Student']['mid_marks']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Student'), array('action' => 'edit', $student['Student']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Student'), array('action' => 'delete', $student['Student']['id']), null, __('Are you sure you want to delete # %s?', $student['Student']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Internal Evaluators'), array('controller' => 'internal_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Internal Evaluator'), array('controller' => 'internal_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('controller' => 'technologies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('controller' => 'technologies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Internal Evaluators');?></h3>
	<?php if (!empty($student['InternalEvaluator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($student['InternalEvaluator'] as $internalEvaluator): ?>
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
<div class="related">
	<h3><?php echo __('Related Technologies');?></h3>
	<?php if (!empty($student['Technology'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($student['Technology'] as $technology): ?>
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
