<!-- Portfolio Grid -->
<section class="bg-light" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading text-uppercase">Portfolio</h2>
			</div>
		</div>
		<div class="row">
			@foreach ($projects as $key => $project)
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal_{{ $key+1 }}">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img class="img-fluid" src="{{ asset($project['image'])}}" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>{!! $project['name'] !!}</h4>
					<p class="text-muted">{!! $project['skills'] !!}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

@push('modals')
	<!-- Portfolio Modals -->
	@foreach ($projects as $key => $project)
	<!-- Modal {{ $key+1 }} -->
	<div class="modal fade bd-example-modal-lg" id="portfolioModal_{{ $key+1 }}" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLiveLabel">{!! $project['name'] !!}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-10 mx-auto">
							<div class="modal-body text-center">
								<!-- Project Details Go Here -->
								<img class="img-fluid d-block mx-auto" src="{{ asset($project['image'])}}" alt="">
								<p>{{ $project['description'] }}</p>
								<ul class="list-inline">
									<li>Website: {{ $project['url'] }}</li>
									<li>Platform: {!! $project['platform'] !!}</li>
									<li>TimeLine: {!! $project['timeline'] !!}</li>
									<li>Team Size: {!! $project['team_size'] !!}</li>
									<li>Skills: {!! $project['skills'] !!}</li>
								</ul>
								<button class="btn btn-primary" data-dismiss="modal" type="button">
									<i class="fa fa-times"></i>
									Close Project</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endpush