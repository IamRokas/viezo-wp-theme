<div class="post flex gap-24 desktop:flex-col pb-40">
	<div class="image w-1/2 desktop:w-full">
		<a href="<?=the_permalink();?>">
			<?php the_post_thumbnail('thumbnail'); ?>
		</a>
	</div>
	<div class="text w-1/2 desktop:w-full font-body-2">
		<a href="<?=the_permalink();?>">
			<h4 class="title"><?=the_title();?></h4>
		</a>
		<p class="short mb-20 desktop:mb-32"><?=get_the_excerpt();?></p>

		<div class="links flex justify-between font-body-2">
			<div class="date"><?=get_the_date('F d, Y');?></div>
			<a href="<?=the_permalink();?>" class="read-more text-button-hover-blue withline">Read more <i class="vicon-ArrowForward"></i></a>
		</div>
	</div>
</div>
