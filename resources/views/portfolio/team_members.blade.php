<!-- Team -->
<section class="bg-light" id="team">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading text-uppercase">Our Amazing Team</h2>
				<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
			</div>
		</div>
		<div class="row">
			@foreach ($members as $key => $member)
			<div class="col-sm-4">
				<div class="team-member">
				<img class="mx-auto rounded-circle" src="{{ asset($member['image'])}}" alt="">
					<h4>{{ $member['full_name'] }}</h4>
					<p class="text-muted">{{ $member['role'] }}</p>
					<p class="text-muted">{{ $member['description'] }}</p>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-lg-8 mx-auto text-center">
				<p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
			</div>
		</div>
	</div>
</section>