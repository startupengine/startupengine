@extends('layouts.app-semanticui')
@section('content')
<div class="ui grid sixteen wide">
    <div class="sixteen wide column">
        <div class="ui message">
            <div class="header">
                Notice
            </div>
            <p>We just updated our privacy policy here to better service our customers. We recommend reviewing the changes.</p>
        </div>
        <div class="ui fluid ordered steps">
            <div class="completed step">
                <div class="content">
                    <div class="title">Create a SitePress account</div>
                    <div class="description">http://sitepress.com/site/luckyrabbit</div>
                </div>
            </div>
            <div class="completed step">
                <div class="content">
                    <div class="title">Billing</div>
                    <div class="description">Enter billing information</div>
                </div>
            </div>
            <div class="active step">
                <div class="content">
                    <div class="title">Integrate Apps</div>
                    <div class="description">Enter your account details</div>
                </div>
            </div>
        </div>
        <div class="ui raised basic segment module" align="center" >
            <p class="header" style="margin-bottom:0px;padding-bottom:0px;">Activity for {{ $trafficTitle }}</p>
            {!! $traffic->render() !!}
        </div>
    </div>
</div>
@endsection