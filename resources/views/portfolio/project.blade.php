@extends('layouts.app')

@push('styles')
    <!-- Custom fonts for this template -->
    <link href="{{ asset('libraries/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('libraries/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/slick/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/customBlog.css') }}">

    <link rel="stylesheet" href="{{ asset('css/customPortfolio.css') }}">
    {{--Fancybox--}}
    <link rel="stylesheet" href="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.css') }}">
@endpush
@push('scripts')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libraries/slick/slick.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('libraries/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Contact form JavaScript-->
    <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('js/contact_me.js') }}"></script>
    {{-- Fancybox --}}
    <script src="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <!-- Custom scripts for this template -->
{{--    <script src="{{ asset('js/agency.js') }}"></script>--}}

@endpush

@section('content')

    @include('portfolio.partials.header_portfolio')
    <section class="padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>
                <div id="sticky_name" class="col-lg-12 text-center sticky-top">
                    <h2 class="text-uppercase">{{ $project->name }}</h2>
                </div>
                <div id="sticky_image" class="image col-md-12 col-lg-6 col-xl-6">
                    <div id="new_style"></div>
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
                    <div class="text-muted">{!! $project->description !!}</div>
                    <h4><a target="_blank" href="{{ $project->url }}">Visit this site</a></h4>
                </div>
            </div>
            @php unset($buf); @endphp
        </div>
    </section>
    @include('portfolio.partials.footer')

    @stack('modals')

@endsection('content')