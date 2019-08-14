<!-- About -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">About</h2>
                <h3 class="section-subheading text-muted">We are a team of PHP developers from Ukraine who create responsive websites, adaptive mibile applications and easy in user desctop applications.
                    We deliver full service from entry analysis to final testing, web deployment and live maintenance of the website.
                    We specialize in web application development, using new technologies to ensure the best possible software solution for our clients.
                    Though, we haven't been long on this freelancing platform, but we already have not few clients.
                    We are eager to progress in any technologic innovations with you would like to use in your work.
                    Our skills:
                    <ul class="text-left">
                        <li>MVC PHP frameworks such as Laravel, micro ones like Slim or Silex.</li>
                        <li>MySQL, MongoDB, Elasticsearch</li>
                        <li>CheddarGetter, PayPal, Eloqua, Amazon, Google, Shopify, Ebanx API's etc</li>
                        <li>SVN and Git</li>
                        <li>phantomjs, nodejs, gulp</li>
                    </ul>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    @foreach ($about as $element)
                        @if ($element['id'] % 2 == 0)
                            <li>
                                <div class="timeline-image">
                                    <img class="rounded-circle img-fluid" src="{{ $element['image'] }}" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>{!! $element['date'] !!}</h4>
                                        <h4 class="subheading">{!! $element['name'] !!}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">{!! $element['description'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @elseif ($element['id'] % 2 == 1)
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <img class="mx-auto rounded-circle img-fluid" src="{{ $element['image'] }}" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>{!! $element['date'] !!}</h4>
                                        <h4 class="subheading">{!! $element['name'] !!}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">{!! $element['description'] !!}  </p>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>