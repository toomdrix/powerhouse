<?php if (count($projects)): ?> 
		<?php $columns = $items[0]->getPrimaryInfo(); ?> 
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover">
				<tbody>
				<?php foreach ($projects as $name=>$items): ?>
					<tr><td colspan="<?php echo count($columns); ?> "><h4><?php echo $name; ?> </h4></td></tr>
					<?php foreach($items as $item): ?>
					<tr>
						<?php foreach ($item->getPrimaryInfo() as $key => $arr): ?>
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
				<?php endforeach; ?> 
				</tbody>
			</table>
		</div>
<?php endif; ?> 