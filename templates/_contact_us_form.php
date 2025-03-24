
<div class="flex gap-20 desktop:gap-28">
	<label for="your-name" class="mb-20 block  flex-1">
		<div class="mb-8 text-white">Name</div>
		<!--<input type="text" class="form-control" name="your-name" id="your-name">-->
		[text* your-name class:form-control]
	</label>

	<label for="your-email"  class="mb-20 block  flex-1">
		<div class="mb-8 text-white">Email Address</div>
		<!--<input type="text" class="form-control" name="your-email" id="your-email">-->
		[email* your-email class:form-control]
	</label>
</div>

<label for="your-company" class="mb-20 block ">
	<div class="mb-8 text-white">Company Name</div>
	<!--<input type="text" class="form-control" name="your-company" id="your-company">-->
	[text* your-company class:form-control]
</label>

<label for="your-company" class="mb-20 block ">
	<div class="mb-8 text-white">Message</div>
	[textarea* your-message class:form-control rows:4]
</label>



<div class="text-center md:text-left">
	<button type="submit" class="wpcf7-form-control wpcf7-submit button uppercase green">Send</button>
</div>
