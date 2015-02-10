<?php if (count($items)): ?>
<div class="table-responsive">
	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr>
				<?php foreach($items[0]->getPrimaryInfo(false) as $key=>$val): ?>
					<th width="<?php echo 100/count($items[0]->getPrimaryInfo(false)); ?>%"><?= $key ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($items as $item): ?>
			<tr>
				<?php foreach ($item->getPrimaryInfo(false) as $key => $arr): ?>
					<td>
						<?php if (isset($arr['link']) && $arr['link']): ?>
							<a <?php if (isset($arr['modal']) && $arr['modal']): ?>data-toggle="modal" data-target="#new-item-modal" <?php endif; ?> href="<?php echo $arr['link'] ?>">
								<?php echo $arr['text']; ?>
							</a>
						<?php else: ?>
							<?php echo $arr['text']; ?>
						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php echo isset($items->links) ? $items->links():''; ?>
<?php else: ?>
	<p>There is nothing to see here...</p>
<?php endif; ?>