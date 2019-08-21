<!-- Portfolio Grid -->
<section class="bg-light" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading text-uppercase">Portfolio</h2>
				<h3 class="section-subheading"></h3>
			</div>
		</div>

		<div class="projects">
			@foreach($projects as $project)
			<div class="projects__slide">
				<div class="row">
					<div class="col-6 row">
						@foreach($project->projectImages as $image)
							@if(!isset($buf))
								<div class="main col-12 text-center">
									<a data-fancybox="{{ $image->projects_id }}" href="{{ asset($image->image_path) }}"><img src="{{ asset($image->image_path) }}" alt=""></a>
								</div>
							@php $buf=1; @endphp
							@else
								<div class="col-4 minor text-center">
									<a data-fancybox="{{ $image->projects_id }}" href="{{ asset($image->image_path) }}"><img src="{{ asset($image->image_path) }}" alt=""></a>
								</div>
							@endif
						@endforeach
					</div>
					<div class="col-6">
						<h3>Name: {{ $project->name }}</h3>
						<h4>Url: {{ $project->url }}</h4>
						{!! $project->description !!}
						<p class="text-center">
							<a href="">
								Learn more ...
							</a>
						</p>
					</div>
				</div>
			</div>
				@php unset($buf); @endphp
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
								<p>{{ $project['description'] }}</p>
								<ul class="list-inline">
									<li>Website: {{ $project['url'] }}</li>
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