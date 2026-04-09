<div class="post flex-col gap-24 desktop:flex-col pb-40">
	<div class="image mb-24 w-full desktop:w-full aspect-square overflow-hidden">
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
	<div class="text w-full desktop:w-full font-body-2">
		<?php
		$categories = get_the_category();
		if (!empty($categories) && $categories[0]->slug !== 'uncategorized') :
		?>
			<div class="category text-sm uppercase font-osp-din mb-8 text-white">
				<?php echo esc_html($categories[0]->name); ?>
			</div>
		<?php endif; ?>


		<a href="<?= the_permalink(); ?>">
			<h4 class="title text-xl font-osp-din uppercase mb-16 text-white"><?= the_title(); ?></h4>
		</a>
		<p class="short mb-20 desktop:mb-32 text-light-grey"><?= get_the_excerpt(); ?></p>

		<div class="links flex justify-between text-sm">
			<div class="date text-sm text-[#818181]"><?= get_the_date('F d, Y'); ?></div>
		</div>
	</div>
</div>