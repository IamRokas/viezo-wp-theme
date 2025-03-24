
<div class="first-row">
	<h2 class="text-center mb-32 header">calculate your efficiency</h2>
	<div class="px-20 md:flex gap-92 md:gap-140">


		<div class="md:w-1/2 col-a">

			<div class="flex fleet-size input-wrap bordered">

				<label class="block text-heading4 w-full" for="fleet-size">
					Fleet size
				</label>

				<input class="form-input" type="number" id="fleet-size" name="fleetsize" value="" required min="1" max="10000">

			</div>

			<div class="axles grid overflow-hidden grid-cols-2 flex-wrap gap-x-32" id="axles-inputs">
				<div class="input-wrap flex items-center col-span-1 whitespace-nowrap gap-16">
					<label class="flex-1">
						4 axle <div class="icon-info tooltip-toggle tooltip cursor-help font-light" data-tip="This information will provide more accurate calculations"></div>
						</label>
					<input type="number" name="axle-4" class="flex-1 form-input">
				</div>
				<div class="input-wrap flex items-center col-span-1 whitespace-nowrap gap-16">
					<label class="flex-1">
						6 axle <div class="icon-info tooltip-toggle tooltip cursor-help font-light" data-tip="This information will provide more accurate calculations"></div>
						</label>
					<input type="number" name="axle-6" class="flex-1 form-input">
				</div>
				<div class="input-wrap flex items-center col-span-1 whitespace-nowrap gap-16">
					<label class="flex-1">
						8 axle <div class="icon-info tooltip-toggle tooltip cursor-help font-light" data-tip="This information will provide more accurate calculations"></div>
						</label>
					<input type="number" name="axle-8" class="flex-1 form-input">
				</div>
			</div>

			<div class="relative milage input-wrap bordered">

				<label class="block text-heading4 mb-40" for="average-mileage">
					Average Mileage
				</label>

				<div class="range-wrap relative">
					<input
						type="range"
						class="
						form-range
						appearance-none
						w-full
						h-6
						p-0
						bg-transparent
						focus:outline-none focus:ring-0 focus:shadow-none
						"
						id="average-mileage"
						name="mileage"
						min="0"
						max="200"
					/>
					<output class="bubble" id="mileage-bubble">125<span>K km</span></output>
				</div>
				<div class="minmax flex justify-between pt-4">
					<div>0 km</div>
					<div>200K km</div>
				</div>
			</div>

			<div class="relative">
				<h3 class="block input-label-small text-heading4">
					GPS
				</h3>
				<div class="input-label-small">
					Are your wagons equipped with GPS trackers?
				</div>

				<div class="flex items-center">
					<div class="form-check form-check-inline mr-32">
						<label class="form-check-label inline-block mb-0" for="gps-yes">
						Yes
							<input class="border-dark-grey w-20 h-20" type="radio" name="gps" id="gps-yes" value="1" checked>
							<span class="field-bg ml-8"></span>
						</label>



					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label inline-block mb-0" for="gps-no">
						No
							<input class="border-dark-grey w-20 h-20" type="radio" name="gps" id="gps-no" value="1">
							<span class="field-bg ml-8"></span>
						</label>
					</div>
				</div>

			</div>

		</div>


		<div class="md:w-1/2 md:pr-32">
			<div class="input-wrap bordered md:hidden"></div>
			<h3 class="input-label-small text-heading4">
				VPI
			</h3>
			<div class="input-label-small">
				Are you following the VPI guidelines?
			</div>

			<div class="flex input-label-small">
				<div class="form-check form-check-inline mr-32">
					<label class="form-check-label inline-block text-gray-800" for="vpi-yes">Yes
						<input class="border-dark-grey w-20 h-20" type="radio" name="vpi" id="vpi-yes" value="1" checked>
						<span class="field-bg ml-8"></span>
					</label>
				</div>
				<div class="form-check form-check-inline">
					<label class="form-check-label inline-block text-gray-800" for="vpi-no">No
						<input class="border-dark-grey w-20 h-20" type="radio" name="vpi" id="vpi-no" value="0">
						<span class="field-bg ml-8"></span>
					</label>
				</div>
			</div>

			<div class="input-label-small">
			Major overhaul routine every:
			</div>

			<div class="flex input-wrap justify-between bordered">
				<div class="year">
					<label class="form-label mr-12" for="overhaul-year">
						Year
					</label>
					<input type="number" class="form-input" name="routine-time" value="10">
				</div>

				<div class="kilometers">
					<label class="form-label mr-12" for="overhaul-year">
						Kilometers
					</label>
					<input type="number" class="form-input" name="routine-km" value="10"><span class="font-medium inline-block pl-8"> (K)</span>
				</div>
			</div>

			<div class="checkboxes input-label-small">
				<h3 class="input-label-small text-heading4">What would be your goal with using Powerail?</h3>

				<div class="flex">
					<?php
						$goals = [
							'Reduce derailment risk',
							'Avoid unplanned maintenance of wheelsets',
							'Reduce overhaul maintenance',
							'Increase customer trust',
							'Monitor the fleet via GPS',
							'Other'
						];
					?>
					<div>
						<?php foreach($goals as $k => $goal): ?>
						<div class="form-check input-label-small">
							<label class="form-check-label inline-block text-gray-800" for="goal-<?=$k;?>">
								<input class="form-check-input" type="checkbox" name="goals[]" value="<?=$goal;?>" id="goal-<?=$k;?>"><span></span>
								<?=$goal;?>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		</div>


	</div>
	<div class="text-center w-4/12 desktop:w-2/12 mx-auto pt-12 desktop:pt-32 buttons-wrap pb-56">
		<button class="button green w-full inline-block relative" id="calculate-button" type="button">Calculate <div class="loader loader-default"></div></button>
	</div>
</div>




<div class="calc-results  bg-primary-green bg-opacity-10 relative overflow-hidden">
	<div id="results-anchor-name" style="position: absolute; bottom: -40px; left: 0"></div>
	<?php
	if(isset($_REQUEST['fleetsize']) && isset($_REQUEST['mileage'])):
		$fleetSize = (int)$_REQUEST['fleetsize'];
		$averageMileage = (int)$_REQUEST['mileage'] * 1000;
		$calc = new Calculator($fleetSize, $averageMileage, 22.8029948630137, 30);
		$calc->calcSavings();
		$roi = $calc->calcRoi();
	?>
	<div class="md:block gap-0 justify-center">

		<div class="col-1 px-28 md:px-0  flex w-full md:flex-1">
			<div class="spacer md:w-1/6"></div>
			<div class="pt-48 pb-40 flex-grow">
				<h3 class="heading text-dark-green input-label-small relative inline-block">Estimated total NET ROI:</h3>
				<ul class="font-normal">
					<li>
						<div class="text">
							Per wagon per 12 years
						</div>
						<div class="result"><span class="number countup" data-number="<?=$roi->perWagonIn12Years;?>">0</span> €</div>
					</li>

					<li>
						<div class="text">
							Per wagon per 1 year
						</div>
						<div class="result"><span class="number countup"data-number="<?=$roi->perWagonIn1Year;?>">0</span>  €</div>
					</li>

					<li>
						<div class="text">
							Total In 12 years
						</div>
						<div class="result"><span class="number countup" data-number="<?=$roi->in12Years;?>">0</span> €</div>
					</li>

					<li>
						<div class="text">
							Total in 1 year
						</div>
						<div class="result"><span class="number countup" data-number="<?=$roi->in1Year;?>">0</span> €</div>
					</li>

				</ul>
			</div>
			<div class="spacer md:w-1/6"></div>
		</div>

		<div class="col-2 flex overflow-hidden px-28 md:px-0 md:w-6/12 text-white z-10 bg-primary-blue md:flex-1">
			<div class="zaibas absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
				<svg width="35" height="79" viewBox="0 0 35 79" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M26.0763 0L0 37.8897H15.9678L6.90798 63L35 26.7707H19.0322L26.0763 0Z" fill="#FFD400"/>
				</svg>
			</div>
			<div class="spacer md:w-1/6"></div>
			<div class="w-full md:w-4/6 pt-48 pb-40 ">
			<h3 class="input-label-small text-center md:text-left">FIND OUT HOW</h3>

			<label for="your-name" class="input-label-small block">
				<div class="mb-8">Name</div>
				<input type="text" class="form-control" name="your-name" id="your-name">
			</label>

			<label for="your-company" class="input-label-small block">
				<div class="mb-8">Company Name</div>
				<input type="text" class="form-control" name="your-company" id="your-company">
			</label>

			<label for="your-email"  class="mb-32 block">
				<div class="mb-8">Email Address</div>
				<input type="text" class="form-control" name="your-email" id="your-email">
			</label>

			<div class="text-center md:text-left">
				<button type="submit" class="wpcf7-form-control wpcf7-submit button uppercase green">Get Recommendations</button>
			</div>

			</div>
			<div class="spacer md:w-1/6"></div>
		</div>


	</div>
	<?php endif; ?>

</div>
