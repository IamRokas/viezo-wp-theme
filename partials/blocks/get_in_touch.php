<?php
$title = $args['block']['title'];
$subtitle = $args['block']['subtitle'];
?>
<div class="get-in-touch text-center py-104 text-darkest-grey">
	<div class="container">
		<h2 class="mb-28"><?= $title; ?></h2>
		<div class="subtitle text-heading-sm font-extralight mb-48"><?= $subtitle; ?></div>

		<?php echo do_shortcode('[contact-form-7 id="236" title="get-in-touch"]'); ?>
		<!--<form>
			<div class="flex justify-center">
				<input type="text" class="form-input flex-1" />
				<button class="button uppercase green" type="submit">Contact Us</button>
			</div>
		</form>-->
	</div>
</div>