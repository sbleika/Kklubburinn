<div class="uppskriftin">
	<?php
	// $data er truthy ef það er útfyllt
	if ($data): ?>
	<section class="skraning">
		<h2><?php echo $data['nafn']; ?></h2>

		<?php if ($data['innskraning'] !== ''): ?>
			<p class="uppskriftin">Uppskriftin: <?php echo $data['innskraning']; ?></p>
		<?php endif; ?>

		<div class="content">
			<?php echo '<p>'.str_replace("\n", "</p><p>", $data['innskraning']).'</p>'; ?>
		</div>

	</section>
	<?php endif; ?>
	<?php if (!$data): ?>
		<p>Fann ekki Uppskriftina!</p>
	<?php endif; ?>
	<p><a href="index.php">← Til baka</a></p>
</div>