@extends('layouts.app-semanticui')
@section('content')
    <div class="eight wide column">
        <div class="ui segment module " align="center" >
            <div align="center" style="line-height:25px;">
                <p class="header">Currently Installed Apps</p>
                <?php if(config('app.ENABLE_GOOGLE_ANALYTICS')) { ?>
                <a href="https://analytics.google.com" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Google Analytics</a>
                <?php } ?>
                <?php if(config('app.ENABLE_MIXPANEL')) { ?>
                <a href="https://mixpanel.com/report" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">MixPanel</a>
                <?php } ?>
                <a href="https://manage.auth0.com/" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Auth0</a>
                <?php if(config('app.ENABLE_INTERCOM')) { ?>
                <a href="https://app.intercom.io" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Intercom</a>
                <?php } ?>
                <?php if(config('app.ENABLE_DRIFT')) { ?>
                <a href="https://app.drift.com" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Drift</a>
                <?php } ?>
                <?php if(config('app.ENABLE_MAILCHIMP')) { ?>
                <a href="https://admin.mailchimp.com" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Mailchimp</a>
                <?php } ?>
                <?php if(config('app.ENABLE_SENTRY')) { ?>
                <a href="https://sentry.io" class="ui basic button" target="_blank"  style="width:100%;text-align:left;">Sentry</a>
                <?php } ?>
            </div>
        </div>
    </div>
@endsection