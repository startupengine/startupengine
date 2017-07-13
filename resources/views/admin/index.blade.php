@extends('layouts.app-semanticui')
@section('content')
<div class="ui grid sixteen wide">
    <div class="sixteen wide column">
        <div class="ui message" align="center">
            <div class="header" align="center">
                Notice
            </div>
            <p>You have <span class="ui label">23</span> unread notifications. You can read them in the <a href="/admin/notifications">notification center</a>.</p>
        </div>
        <div class="ui fluid ordered tablet stackable steps">
            <div class="completed step">
                <div class="content">
                    <div class="title">Create a SitePress account</div>
                    <div class="description">https://sitepress.co/site/luckyrabbit</div>
                </div>
            </div>
            <div class="completed step">
                <div class="content">
                    <div class="title">Make some content</div>
                    <div class="description">Create landing pages & blog posts</div>
                </div>
            </div>
            <div class="active step">
                <div class="content">
                    <div class="title"><a href="/admin/settings/apps">Integrate Apps</a></div>
                    <div class="description">Add chat, analytics, etc</div>
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