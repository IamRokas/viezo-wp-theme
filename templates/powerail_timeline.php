<?php

/**
 * Function to display the timeline component
 * 
 * @param array $elements Array of timeline elements
 * @return void Outputs HTML directly
 */
?>
<div class="bg-dark-grey py-64 ">
    <div class="container text-white">
        <div id="powerail-animation-container" class="mt-80 h-[700vh] desktop:h-[600vh] relative">
            <h2 class="text-center py-48">POWERAIL</h2>
            <div class="sticky top-0">
                <div class="relative h-screen pb-48 pt-104">
                    <div class="powerail-card h-[30vh] z-[10]">
                        <div class="hidden desktop:block"></div>
                        <div class="h-full col-start-1 desktop:col-start-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/anim-assets/1-01.png" />
                        </div>
                        <div
                            class="powerail-text desktop:flex desktop:flex-col desktop:justify-center col-start-2 desktop:col-start-3">
                            <h3 class="text-xl desktop:text-2xl mb-20">Holder</h3>
                            <p class="text-[16px]  font-hiragino-sans">The stainless steel Powerail
                                holder is
                                designed to fit
                                various axleboxes.</p>
                        </div>
                    </div>

                    <div class="powerail-card h-[30vh] z-[50]">
                        <div
                            class="powerail-text desktop:flex desktop:flex-col desktop:justify-center col-start-2 desktop:col-start-1">
                            <h3 class="text-xl desktop:text-2xl mb-20">Sensor</h3>
                            <p class=" text-[16px]  font-hiragino-sans">The sensor measures three-axis
                                vibrations at
                                set
                                intervals, transmitting data to a gateway. Its high-resolution MEMS accelerometer
                                detects up to
                                64 G, making it ideal for high-vibration environments.</p>
                        </div>
                        <div class="h-full col-start-1 row-start-1 desktop:col-start-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/anim-assets/2-01.png" />
                        </div>
                        <div class="hidden desktop:block"></div>
                    </div>

                    <div class="powerail-card h-[30vh] z-[30]">
                        <div class="hidden desktop:block"></div>
                        <div class="h-full col-start-1 desktop:col-start-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/anim-assets/3-01.png" />
                        </div>
                        <div
                            class="powerail-text desktop:flex desktop:flex-col desktop:justify-center col-start-2 desktop:col-start-3">
                            <h3 class="text-xl desktop:text-2xl mb-20">Energy harvester</h3>
                            <p class="text-[16px]  font-hiragino-sans">The vibration harvester uses a
                                unique
                                piezoelectric
                                PVDF polymer on a cantilever. As it vibrates, it generates electricity, which is stored
                                in a
                                supercapacitor.</p>
                        </div>
                    </div>

                    <div class="powerail-card h-[30vh] z-[20]">
                        <div
                            class="powerail-text desktop:flex desktop:flex-col desktop:justify-center col-start-2 desktop:col-start-1">
                            <h3 class="text-xl desktop:text-2xl mb-20">Supercapacitor</h3>
                            <p class="text-[16px]  font-hiragino-sans">The supercapacitor has low
                                self-discharge,
                                high
                                voltage, a wide temperature range, and high capacitance. It stores energy when unused
                                and
                                releases it as needed.</p>
                        </div>
                        <div class="h-full col-start-1 row-start-1 desktop:col-start-2 grid grid-cols-1">
                            <img class="col-start-1 row-start-1 swap-image-1 transition-all duration-300"
                                src="<?php echo get_template_directory_uri(); ?>/anim-assets/4-01.png" />
                            <img class="col-start-1 row-start-1 swap-image-2 transition-all duration-300 opacity-0"
                                src="<?php echo get_template_directory_uri(); ?>/anim-assets/4-02.png" />
                        </div>
                        <div class="hidden desktop:block"></div>
                    </div>

                    <div class="powerail-card h-[30vh] z-[50]">
                        <div class="hidden desktop:block"></div>
                        <div class="h-full col-start-1 desktop:col-start-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/anim-assets/5-01.png" />
                        </div>
                        <div
                            class="powerail-text desktop:flex desktop:flex-col desktop:justify-center col-start-2 desktop:col-start-3">
                            <h3 class="text-xl desktop:text-2xl mb-20">Upper case</h3>
                            <p class="text-[16px]  font-hiragino-sans">The upper case is ABS with an IP66
                                rating,
                                featuring a
                                heavy-duty 3.3 mm thick wall design. It is dustproof, waterproof, and flame retardant.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>