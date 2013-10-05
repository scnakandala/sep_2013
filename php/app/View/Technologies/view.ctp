<div class="technologies view">
<h2><?php  echo __('Technology');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($technology['Technology']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($technology['Technology']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Technology'), array('action' => 'edit', $technology['Technology']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Technology'), array('action' => 'delete', $technology['Technology']['id']), null, __('Are you sure you want to delete # %s?', $technology['Technology']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Technologies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Technology'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List External Evaluators'), array('controller' => 'external_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New External Evaluator'), array('controller' => 'external_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related External Evaluators');?></h3>
	<?php if (!empty($technology['ExternalEvaluator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Gmail Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($technology['ExternalEvaluator'] as $externalEvaluator): ?>
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
	<h3><?php echo __('Related Students');?></h3>
	<?php if (!empty($technology['Student'])):?>
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
		foreach ($technology['Student'] as $student): ?>
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
