@include('app.partials.css.libraries')
@include('app.partials.css.buttons')
@include('app.partials.css.gradients')
@include('app.partials.css.navigation')
@include('app.partials.css.inputs')
@include('app.partials.css.tables')
@include('app.partials.css.cards')
@include('app.partials.css.badges')
@include('app.partials.css.editors')
@include('app.partials.css.layout')
@include('app.partials.css.typography')
@include('app.partials.css.modals')
@include('app.partials.css.utilities')

<style>
    #admin-sidebar .btn.active{
        border-color:#eee !important;
        background:royalblue !important;
        color:#fff !important;
    }

    #admin-sidebar .btn:hover, #admin-sidebar .navbar .navbar-nav>a.btn:hover {
        box-shadow:none;
        background: #efefef !important;
        color:#222 !important;
    }

    #adminNav {
        background:#2b2b2b !important;
        box-shadow:0px 5px 15px rgba(0,0,200,0.15) !important;
    }
</style>