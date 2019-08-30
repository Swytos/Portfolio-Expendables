<!-- Team -->
<section class="bg-light" id="team">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading text-uppercase">Our Amazing Team</h2>

				<h3 class="section-subheading text-muted">
					We are a team of PHP developers from Ukraine who create responsive websites, adaptive mibile applications and easy in user desctop applications. We deliver full service from entry analysis to final testing, web deployment and live maintenance of the website. We specialize in web application development, using new technologies to ensure the best possible software solution for our clients. Though, we haven't been long on this freelancing platform, but we already have not few clients. We are eager to progress in any technologic innovations with you would like to use in your work.
				</h3>
			</div>
		</div>
		<div class="sl">
			@foreach ($members as $key => $member)
				<div class="sl__slide">
					<div class="team-member">
						<img class="mx-auto rounded-circle" src="{{ asset($member['image'])}}" alt="">
						<h4>{!! $member['full_name'] !!}</h4>
						<p class="text-muted">{!! $member['role'] !!}</p>
						<p class="text-muted">{!! $member['description'] !!}</p>
					</div>
				</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-lg-8 mx-auto text-center">
				<p class="large text-muted"></p>
			</div>
		</div>
	</div>
</section>