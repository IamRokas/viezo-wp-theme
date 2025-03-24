<?php
$title = $args['block']['left_side']['title'];
$description = $args['block']['left_side']['description'];
$button = $args['block']['left_side']['button'];
// OLD: $image = get_template_directory_uri().'/build/images/powerail-software-1.png';
$image = 'https://viezo.lt/wp-content/uploads/2023/06/exchange-of-data-with-whote.png';

?>

<div class="vblock software pt-48 pb-58 desktop:pt-84 desktop:pb-84 relative">
	<div class="bg"></div>
	<div class="container relative desktop:flex justify-between items-center text-white text-right">
		<div class="desktop:w-1/2 image-column pb-48 desktop:pb-64">
			<img src="<?=$image;?>" class="mx-auto desktop:ml-0" alt="Software" />
		</div>
		<div class="desktop:w-1/2 data-column text-left desktop:text-right">
			<h3 class="mb-28 h2"><?=$title;?></h3>
			<p class="font-body-1 text-white ">
				<?=$description;?>
			</p>
			<?php if(!empty($button)): ?>
				<a href="<?=$button['url'];?>" class="button green"><?=$button['title'];?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
