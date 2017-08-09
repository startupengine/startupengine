@extends('layouts.webslides')

@section('title')Help
@endsection

@section('styles')
    <style>
        @media (min-width: 1024px) {
            .flexblock li {
                width: 50%;
            }
        }
    </style>
@endsection

@section('content')
    <article>
        <section class="" style="min-height:auto !important;">
            <!-- Overlay/Opacity: [class*="bg-"] > .background.dark or .light -->
            <!--.wrap = container width: 90% -->
            <div class="wrap" style="">
                <h2 align="center">Help & Support</h2>
                <ul class="flexblock">
                    @foreach($defaults->getHelpMenu()->getItems() as $item)
                        @include('components.helpItem')
                    @endforeach
                </ul>
            <!-- .end .wrap -->
            </div>
        </section>
    </article>
@endsection