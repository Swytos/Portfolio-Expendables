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
					<div class="image col-md-12 col-lg-6 col-xl-6">
						<div class="row">
						@foreach($project->projectImages as $image)
								@if(!isset($buf))
									<div class="main col-12 text-center">
										<a data-fancybox="{{ $image->projects_id }}" href="{{ asset($image->image_path) }}"><img src="{{ asset($image->image_path) }}" alt=""></a>
									</div>
									@php $buf=1; @endphp
								@else
									<div class="col-4 minor text-center d-none d-sm-block">
										<a data-fancybox="{{ $image->projects_id }}" href="{{ asset($image->image_path) }}"><img src="{{ asset($image->image_path) }}" alt=""></a>
									</div>
								@endif

						@endforeach
						</div>
					</div>
					<div class="info col-md-12 col-lg-6 col-xl-6">
						<h3 class="text-center">{{ $project->name }}</h3>
						<h4><a target="_blank" href="{{ $project->url }}">Visit this site</a></h4>
						<div class="description text-muted">{!! str_limit($project->description,'500','...') !!}</div>
						<div class="learn text-center">
							<a href="{{ route('project', ['project_id' => $project->id]) }}">
								Learn more ...
							</a>
						</div>
					</div>

				</div>
			</div>
				@php unset($buf); @endphp
			@endforeach
		</div>
	</div>
</section>