@extends('layouts.webslides')

@section('title')Articles@endsection
@section('styles')
    <style>
        section.bg-gradient-h .button.ghost, section.bg-gradient-v .button.ghost, section.bg-gradient-r .button.ghost{
            border-color:#fff !important;
            font-weight:normal !important;
        }
        section.bg-gradient-h .button.ghost:hover, section.bg-gradient-v .button.ghost:hover, section.bg-gradient-r .button.ghost:hover {
            color:#222 !important;
            background:#fff !important;
        }
        @media (min-width: 768px) {
            section:first-of-type {
                padding-top:100px !important;
                padding-bottom:100px !important;
            }
        }
        @media (max-width: 768px) {
            section:first-of-type {
                padding-top:75px !important;
                padding-bottom:75px !important;
            }
        }
        body {
            background:#fff;
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