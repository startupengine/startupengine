@extends('layouts.webslides')

@section('title')Articles
@endsection

@section('content')
    <article>
        <section class="">
            <!-- Overlay/Opacity: [class*="bg-"] > .background.dark or .light -->
            <!--.wrap = container width: 90% -->
            <div class="wrap">
                <h2 align="center">Articles</h2>
                <ul class="flexblock gallery">
                    @foreach($articles as $item)
                        @include('components.galleryItem')
                    @endforeach
                </ul>
                <!-- .end .wrap -->
        </section>
    </article>
@endsection