@extends('layouts.app-semanticui')
@section('content')
    <div class="ui grid sixteen wide">
        <div class="sixteen wide column" align="center">
            <p class="header" style="margin-bottom:35px;padding-bottom:0px;">Site Settings</p>
            <div class="eight wide column">
                <div class="ui segments">
                    <div class="ui raised basic segment" align="center">
                        <div align="center" style="line-height:25px;">
                            <p class="header">Your Apps</p>
                            <?php if(config('app.ENABLE_GOOGLE_ANALYTICS')) { ?>
                            <a href="https://analytics.google.com/" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Google Analytics</a>
                            <?php } ?>
                            <?php if(config('app.ENABLE_MIXPANEL')) { ?>
                            <a href="https://mixpanel.com/report" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">MixPanel</a>
                            <?php } ?>
                            <a href="https://manage.auth0.com/" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Auth0</a>
                            <?php if(config('app.ENABLE_INTERCOM')) { ?>
                            <a href="https://app.intercom.io" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Intercom</a>
                            <?php } ?>
                            <?php if(config('app.ENABLE_DRIFT')) { ?>
                            <a href="https://app.drift.com" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Drift</a>
                            <?php } ?>
                            <?php if(config('app.ENABLE_MAILCHIMP')) { ?>
                            <a href="https://admin.mailchimp.com" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Mailchimp</a>
                            <?php } ?>
                            <?php if(config('app.ENABLE_SENTRY')) { ?>
                            <a href="https://sentry.io" class="ui basic button" target="_blank"  style="width:100%;text-align:left;margin-bottom:5px;">Sentry</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="ui bottom attached basic segment">
                        <div align="center">
                            <button class="ui right labeled icon button">
                                Configure App Settings
                                <i class="setting icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection