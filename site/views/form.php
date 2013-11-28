
<?php
header('Content-Type: text/html; charset=utf-8');
// til hægðarauka - prentar út "invalid" sem við notum í class nafn á input ef það er villa þar
function is_invalid($field, $errors)
{
	// er einhver villa í fylkinu sem á við gefið field?
	foreach ($errors as $error)
	{
		// ef svo, prenta "invalid" og hætta
		if ($error->field === $field)
		{
			echo "invalid";
			return;
		}
	}
}
?>
			
			<section class="add">
				<?php
				// birtum aðeins villur ef einhverjar eru
				if (sizeof($uppskriftin->errors()) > 0): ?>
					<div class="errors">
						<ul>
						<?php foreach ($uppskriftin->errors() as $error): ?>
							<li><label for="<?php echo $error->field; ?>"><?php echo $error->error; ?></label></li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php
				// búum handvirkt til formið okkar og merkjum input með "invalid" ef villa á við þau og prentum út gildi hlutar ef þau eiga við
				?>

				<h2>Skráning</h2>
				<form method="post" action="skraning.php">
					<div>
						<label for="nafn">Nafn á uppskriftinni:<abbr title="Nauðsynlegt að fylla út">*</abbr></label>
						<input type="text" id="nafn" name="nafn" class="<?php is_invalid('nafn', $uppskriftin->errors()); ?>" placeholder="Frönsk súkkulaðikaka" value="<?php echo $uppskriftin->nafn; ?>">
					</div>

					<div>
						<label for="tegund">Tegund af köku:<abbr title="Nauðsynlegt að fylla út">*</abbr></label>
						<input type="text" id="tegund" name="tegund" class="<?php is_invalid('tegund', $uppskriftin->errors()); ?>" placeholder="formkaka, spariterta, múffa, jólakaka" value="<?php echo $uppskriftin->tegund; ?>">
					</div>

					<div>
						<label for="innskraning">Uppskriftin sjálf:<abbr title="Nauðsynlegt að fylla út">*</abbr></label>
						<textarea name="innskraning" class="<?php is_invalid('innskraning', $uppskriftin->errors()); ?>" id="innskraning" ><?php echo $uppskriftin->innskraning; ?> </textarea>

					</div>



					<div class="buttons">
						<input type="submit" value="Leggja inn í bankann" />
					</div>
				</form>
			</section>

