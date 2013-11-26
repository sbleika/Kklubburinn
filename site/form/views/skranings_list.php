
<div class="uppskriftin">
<?php foreach($select as $data): ?>
	<section class="uppskriftin">data
		<h2><a href="index.php?event=<?php echo $data['id']; ?>"><?php echo $data['tegund']; ?></a></h2>

	</section>
<?php endforeach; ?>
</div>