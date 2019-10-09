<section name="blog" class="blog" id="blog">

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
            @foreach ($posts as $post)
            <div class="post">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-4 test1">
{{--                        {{ dd($post->postTags) }}--}}
                        <img src="
                        {{ $post->postImages->first()->image_path }}
                        " alt="">
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <h3 class="text-center"> {{ $post->post_title }}</h3>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <i class="fas fa-calendar-alt"></i> {{ $post->created_at->toDateString() }}
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <i class="fa fa-list-alt" aria-hidden="true"></i> {{ $post->post_category }}
                            </div>
                            <div class="col-12 col-lg-12 col-xl-12">
                                <p class="text-muted">
                                    {!! substr(preg_replace("/<img[^>]+\>/i", "", $post->post_content), 0, 200) !!}
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-6 col-xl-6">
                                <p><i class="fas fa-tags"></i>
                                    @foreach($post->postTags as $tag)
                                    <a href="#" class="badge badge-secondary">{{ $tag->tag->tag_name }}</a>
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-6 col-xl-6 text-center">
                                <a href="{{ route('post') }}" role="button" class="btn btn-outline-secondary">Read details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div>
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <div class="card" id="card">
                <div class="about">
                    <h3 class="text-center">About Blog</h3>
                    <p class="text-muted">
                        The most interesting news, the most important events - all this we cover in our blog. If you are interested in and browsing the blog materials in time, you can find out a lot of useful things about our school, about the latest news and world trends.
                    </p>
                </div>
                <hr>
                <div class="categories">
                    <button style="text-decoration: none" aria-controls="categories" class="btn btn-link text-left collapsed" name="categories" data-toggle="collapse" data-target="#categories" aria-expanded="false">
                        <h3><i class="fa fa-list-alt" aria-hidden="true"></i> Categories</h3>
                    </button>
                    <div id="categories" class="collapse" data-parent=".categories">
                        <ul class="text-muted list">
                            <hr>
                            @foreach ($categories as $category)
                                <li><a href="#" class="linkactive">{{ $category->category }}</a><hr></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="tags">
                    <button style="text-decoration: none" class="btn btn-link text-left collapsed" name="tags" data-toggle="collapse" data-target="#tags" aria-expanded="false">
                        <h3><i class="fas fa-tags"></i>Tags</h3>
                    </button>
                    <div id="tags" class="collapse" data-parent=".tags">
                        @foreach ($tags as $tag)
                        <a href="#" class="badge badge-secondary tag">{{ $tag->tag_name }}</a>
                        @endforeach
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</section>
