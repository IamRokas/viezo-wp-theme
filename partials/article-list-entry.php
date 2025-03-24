<div class="post flex gap-24 desktop:flex-col pb-40">
	<div class="image w-1/2 desktop:w-full aspect-square overflow-hidden">
		<a href="<?= the_permalink(); ?>">
			<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('case-study', ['class' => 'w-full h-full object-cover']);
			} else {
				echo '<div class="bg-dark-grey h-64 w-full"></div>';
			}
			?>
		</a>
	</div>
	<div class="text w-1/2 desktop:w-full font-body-2">
		<?php
		$categories = get_the_category();
		if (!empty($categories)) :
		?>
			<div class="category text-sm uppercase font-osp-din mb-8 text-white">
				<?php echo esc_html($categories[0]->name); ?>
			</div>
		<?php endif; ?>

		<a href="<?= the_permalink(); ?>">
			<h4 class="title text-xl font-osp-din uppercase mb-16 text-white"><?= the_title(); ?></h4>
		</a>
		<p class="short mb-20 desktop:mb-32 text-light-grey"><?= get_the_excerpt(); ?></p>

		<div class="links flex justify-between font-body-2">
			<div class="date text-sm text-light-grey"><?= get_the_date('F d, Y'); ?></div>
		</div>
	</div>
</div>