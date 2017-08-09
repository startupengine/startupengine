@extends('layouts.webslides-errors')

@section('title')Error
@endsection

@section('meta')
    <meta name="description" content="Error">
@endsection

@section('styles')
    <style>
        header {
            height:100vh !important; z-index:-2 !important;
        }
        .sentry-error-embed {
            margin-top:10% !important;
        }
    </style>
@endsection

@section('content')
    <article>
        <div class="content" style="">
        @unless(empty($sentryID))
            <!-- Sentry JS SDK 2.1.+ required -->
                <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

                <script>
                    Raven.showReportDialog({
                        eventId: '{{ $sentryID }}',

                        // use the public DSN (dont include your secret!)
                        dsn: '<?php echo config('app.SENTRY_PUBLIC_DSN'); ?>'
                    });
                </script>
            @endunless
        </div>
        <section class="">
            <!-- Overlay/Opacity: [class*="bg-"] > .background.dark or .light -->
            <span class="background" ></span>
            <!--.wrap = container width: 90% -->
            <div class="wrap zoomIn" align="center" style="padding:75px 10%;min-width:300px;">
                <h1 style="margin-bottom:15px;">
                    <strong>Uh Oh!</strong>
                </h1>
                <div class="text-subtitle"><p>Page not found.</p></div>
                <p>
                    <a href="/" class="button ga-track" data-ga-text="Take me to the homepage." title="Take me to the homepage.">
                        Take me to the homepage.
                    </a>
                </p>
            </div>
            <!-- .end .wrap -->
        </section>
    </article>
@endsection