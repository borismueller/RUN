<?php if (!empty($files)) : ?>
	<?php foreach ($files as $file) : ?>
		<div class="object">
			<div class="item">
				<div class="item-type">itemtype</div>
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
