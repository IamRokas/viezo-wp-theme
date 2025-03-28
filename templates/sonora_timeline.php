 <div class="bg-dark-grey pt-20">
 	<div class="container text-white">
 		<div id="sonora-animation-container" class="h-[600vh] desktop:h-[500vh] relative">
 			<h2 class="text-center py-48">SONORA</h2>
 			<div class="sticky top-0">

 				<div class="relative h-screen pb-48 pt-104 desktop:flex desktop:items-center
">
 					<div
 						class="h-full desktop:h-auto grid grid-cols-2 desktop:grid-cols-8 desktop:grid-rows-8 gap-10 desktop:gap-48">
 						<div
 							class="sonora-text-block col-start-1 col-span-2 row-start-1 desktop:col-start-1 desktop:col-span-3 desktop:row-start-1 desktop:row-span-3 opacity-0 transition-all duration-1000">
 							<h3 class="text-xl desktop:text-2xl mb-20">QUICK AND EASY STARTUP</h3>
 							<p class="text-[16px] desktop:text-lg font-hiragino-sans">No contextual information about
 								the equipment
 								is
 								required. The sensor can be installed in less than a minute.</p>
 						</div>
 						<div
 							class="sonora-text-block col-start-1 col-span-2 row-start-1 desktop:col-start-1 desktop:col-span-3 desktop:row-start-4 desktop:row-span-3 opacity-0 transition-all duration-1000">
 							<h3 class="text-xl desktop:text-2xl mb-20">DOWNTIME - 0 min</h3>
 							<p class="text-[16px] desktop:text-lg font-hiragino-sans">Plan your repair work at a
 								convenient time
 								when
 								operations are not running. Reduce downtime due to mechanical joint failures to zero.
 							</p>
 						</div>
 						<div
 							class="sonora-text-block col-start-1 col-span-2 row-start-1 desktop:col-start-6 desktop:col-span-3 desktop:row-start-2 desktop:row-span-3 opacity-0 transition-all duration-1000">
 							<h3 class="text-xl desktop:text-2xl mb-20">INFORMATION ABOUT FAULTS, NOT SHOCKS</h3>
 							<p class="text-[16px] desktop:text-lg font-hiragino-sans">The system informs you about real
 								impending
 								faults,
 								not vibration shocks caused by random impacts around the equipment.</p>
 						</div>
 						<div
 							class="sonora-text-block col-start-1 col-span-2 row-start-1 desktop:col-start-6 desktop:col-span-3 desktop:row-start-5 desktop:row-span-3 opacity-0 transition-all duration-1000">
 							<h3 class="text-xl desktop:text-2xl mb-20">INSTANT ROI</h3>
 							<p class="text-[16px] desktop:text-lg font-hiragino-sans">Thanks to favourable pricing, the
 								return on
 								investment can be immediate, starting from the very first month of system use.</p>
 						</div>
 						<div
 							class="col-span-2 row-start-2 row-span-3 desktop:col-start-4 desktop:col-span-2 desktop:row-start-1 desktop:row-span-8 flex justify-center desktop:justify-normal desktop:grid items-center h-full">
 							<div id="sonora-sprite-container" class="sonara-image w-1/2 desktop:w-full">
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<div class="text-center mt-32 flex gap-12 items-center py-28 border-t border-white justify-center">
 		<p class="text-white mb-0">Need more information?</p>
 		<a href="<?= esc_url($read_more_link['url'] ?? get_post_type_archive_link('case-study')); ?>"
 			class="button outline-white">
 			Contact Us
 		</a>
 	</div>
 </div>

 <style>
 	.sonara-image {
 		background-image: url('<?php echo get_template_directory_uri(); ?>/anim-assets/spritesheet.png');
 		background-size: cover;
 		background-repeat: no-repeat;
 		aspect-ratio: 0.5046923;
 	}
 </style>