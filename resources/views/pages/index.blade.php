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
                        <?php
                        $tags = $item->getTags();
                        if (in_array("Landing", $tags) OR in_array("Hidden", $tags) OR in_array("Page", $tags)) {
                        } else {
                        ?>
                        @include('components.galleryItem')
                        <?php } ?>
                    @endforeach
                </ul>
                <!-- .end .wrap -->
        </section>
    </article>
@endsection