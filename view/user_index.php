<?php if (!empty($files)) : ?>
	<?php foreach ($files as $file) : ?>
		<div class="object">
			<div class="item">
				<?php $extension = pathinfo($file->path,PATHINFO_EXTENSION);
				switch ($extension) {
					case 'png':
					echo '<div class="item-type"><img src="'.$file->path.'" height="42" width="42"></div>';
					break;

					case 'jpg':
					echo '<div class="item-type"><img src="'.$file->path.'" height="42" width="42"></div>';
					break;

					default:
					echo '<div class="item-type">.'.$extension.'</div>';
					break;
				}
				?>
				<div class="item-desc">
					<div class="item-desc-name"><?= $file->name ?></div>
					<div class="item-desc-icon">icon</div>
				</div>
			</div>
			<?php if (!empty($file->tags)) : ?>
				<div class="tag">
					<div class="tag-text"><?= $file->tags ?></div>
					<div class="tag-icon">&#10005;</div>
				</div>
			<?php endif ?>
		</div>
	<?php endforeach ?>
<?php endif ?>
<div class="object">
	<div class="plus" onclick="location='/user/upload'">+</div>
</div>
