@extends('layouts.shards_frontend')

@section('title') Subscribe @endsection

@section('css')
    <style>
        td {
            line-height: 28px;
            vertical-align: middle;
        }

        nav li.page-item {
            box-shadow: none !important;
            border: 1px solid #ddd;
            border-right: 0px;
        }

        nav li.page-item:last-of-type {
            border-right: 1px solid #ddd;
        }

        nav li.page-item.active a {
            background: #555 !important;
        }

        nav li.page-item.active {
            border-color: #555;
        }

        nav li.page-item:hover a {
            color: #000 !important;
        }

        nav li.page-item.active:hover a {
            color: #fff !important;
        }

        .page-item a {
            color: #888;
        }

        table .badge-pill {
            min-width: 80px;
        }

        .actionButton {
            width: 120px !important;
        }

        .postTypeSelector {
            background: rgba(126, 186, 255, 0.1);
            border-left: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            padding: 15px 0px;
            transition: all 0.5s;
        }

        .postTypeSelector:hover {
            background: rgba(95, 114, 255, 0.1);
            border-left: 2px solid #333;
            cursor: pointer;
        }

        .postTypeSelector:last-of-type {
            margin-bottom: 0px !important;
        }

        .modal-header .close {
            padding: 1.25rem 5px;
            margin: -1rem -1rem -1rem auto;
        }

        .modal-footer {
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            padding-left: 25px;
        }

        .card .postTag {
            display: none;
        }

        .card .postTag:first-of-type {
            display: inline-flex;
        }

        .modal .input-group-text {
            min-width: 130px;
        }

        #docsApp .card ul {
            line-height: 15%;
        }

        #docsApp .card {
            margin-bottom: 20px;
        }

        .hljs-attribute {
            color: mediumseagreen;
            font-weight: bold;
        }

        .table-sm td p {
            margin-bottom: 5px;
            text-align: left;
        }

        .table-sm td p code {
            text-align: left;
            padding-left: 0px;
        }

        .card-small {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .documentation-card {
            max-height: none !important;
            box-shadow: none !important;
        }

        pre {
            background: #333;
            border-radius: 4px;
            color: #fff;
            padding: 5px 20px;
        }

        .page-title > h1 {
            font-size: 25px !important;
        }

        .text-white p, .text-white h1, .text-white h2, .text-white h3, .text-white h4, .text-white h5, .text-white h6 {
            color: #fff !important;
        }

        .shards-landing-page--1 .welcome {
            height: auto !important;
            max-height: auto !important;
            min-height: 500px;
            background: none;
            /*background-image:url('https://images.unsplash.com/photo-1508796079212-a4b83cbf734d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80');*/
        }

        .shards-landing-page--1 .welcome h1 {
            margin: 80px 0px;
        }

        .documentation-card li {
            line-height: 250% !important;
            font-size: 110% !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            color: #2568ff;
            font-weight: 500;
        }

        .documentation-card h1 {
            font-size: 150% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h2 {
            font-size: 125% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h3 {
            font-size: 110% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h4 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h5 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h6 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            background: #e2f0ff;
            border-radius: 4px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .documentation-card h2 {
            opacity: 0.9;
        }

        .documentation-card h3 {
            opacity: 0.75;
        }

        .documentation-card > .card-body h1:first-child {
            font-size: 150% !important;
            color: #3d5170;
            background: none !important;
            padding: 0px !important;
            margin-top: 10px;
            margin-bottom: 25px;
            padding-bottom: 15px !important;
            border-bottom: 1px solid #eee;
            border-radius: 6px !important;
        }

        .nav .nav-link.active {
            background: #dae4f97d !important;
        }

        .nav {
            border-radius: 5px !important;
        }

        .documentation-card .nav-link {
            border-radius: 0px !important;
        }

        .documentation-card .nav-item:first-of-type .nav-link {
            border-radius: 5px 5px 0px 0px !important;
        }

        .documentation-card.border, #sidebar {
            border: 1px solid rgba(0, 100, 150, 0.2) !important;
        }

        #description h1, #description h2, #description h3, #description h4, #description h5, #description h6 {
            margin: 15px;
            font-weight: 300;
        }

        #description {
            text-align: center !important;
        }

        .affix {
            position: fixed;
            top: 72;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        /* fixed to top styles */
        .affix.navbar {
            background-color: #333;
        }

        .affix.navbar .nav-item > a,
        .affix.navbar .navbar-brand {
            color: #fff;
        }

        .card-header {
            background: #edfff6;
            color: #8ac1b2 !important;
        }
    </style>
    <style>
        #contentApp {
            display: contents !important;
            width: 100% !important;
        }

        .card-subtitle, .card-title {
            color: #333 !important;
        }

        .text-dull-blue h5, .text-dull-blue h6 {
            color: #557698 !important;
            text-align: center;
        }

        .card-subtitle {
            opacity: 0.7;
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>

    <style>
        /**
       * The CSS shown here will not be introduced in the Quickstart guide, but shows
       * how you can use CSS to style your Element's container.
       */
        .StripeElement {
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            margin-right: 5px;
            margin-left: 5px;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            margin-top: 10px !important;
        }

        #subscribeForm .btn-success {
            display: none;
        }

        #subscribeForm .btn-danger {
            display: none;
        }

        #subscribeForm.status-success .btn-success {
            display: inline-block;
        }

        #subscribeForm.status-error .btn-danger {
            display: inline-block;
        }

        .input-group {
            margin-bottom: 15px;
            margin-top: 15px;
        }

        .input-group-addon {
            min-width: 50px;
            background: #eee;
            border-radius: 5px 0px 0px 5px;
            color: #a3aac5 !important;
            padding: 13px;
        }

        .input-group-addon i {
            color: #a3aac5 !important;
        }

        .btn-login {
            color: #fff;
            border: 1px solid #858a94 !important;
            padding: 9px 25px 10px 25px;
            background: linear-gradient(#858a94, #2d2d33) !important;
            margin: 0px 10px !important;
        }

        .input-group-addon i.text-danger {
            opacity: 0.66 !important;
        }

        .input-group-addon-danger {
            background: #ffdfe2;
        }

        @media (min-width: 768px) {
            #formCard {
                margin-top: -87px !important;
            }

            .margin-top-72-large {
                margin-top:-72px;
            }
        }

        .bg-white {
            display:inline-block !important;
        }

        .shards-landing-page--1 .welcome:before {
            background: linear-gradient(30deg, #ff568f 0%, #ff4760 35%, #ffe09b 100%) !important;
        }

        #topNavbar {
            background: rgba(250, 50, 50, 0.15) !important;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Content @endsection

@section('header')

    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container" id="">
        <div class="row">
            <div class="col-md-12 px-4 text-white text-center py-5" id="description">
                <h2 class="page-title mb-4">Subscribe</h2>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection


@section('content')


    <main id="content">

        <div class="blog section section-invert pt-4 pb-0 full-screen-section"
             style="border:none; min-height:calc(100vh - 300px) !important;">

            <div class="container">
                <div class="col-md-12 justify-content-center">
                    <div class="row">
                        <div class="col-md-4  text-center">
                            <div class="mt-0"
                                 style="min-height:auto !important;border-radius:10px;    margin-top: -62px !important;">
                                <div class="card-body pt-0">
                                    <h5 class="text-light">{{ $product->name }}</h5>
                                    <p class="pt-3 mb-2"><strong><span
                                                    class="text-primary">${{ $plan->price/100 }}</span>
                                            / {{ $plan->interval }}</strong></p>
                                    <p class="pb-0 pt-2 mb-2"> {{ $product->description }}</p>
                                    @if($plan->description != null) <p class="pt-2"> {{ $plan->description }}</p> @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">

                                <div class="card mx-auto mb-3 mt-0 px-3 bg-very-light-blue-alt w-100" id="formCard"
                                     style="
                                    min-height: auto !important;
                                    box-shadow: 0px 15px 45px rgba(0,0,70,0.1) !important;
                                    border: 1px solid #dfecf7 !important;
                                    background: #f6f8ff !important;"
                                     >
                                    <div class="card-body" style="min-height:auto !important;">
                                        <form v-on:submit.prevent="onSubmit" id="payment-form" class="mb-0"
                                              style="max-width:100%;">
                                            <div class="form-row justify-content-left  pt-3">
                                                <div class="badge badge-primary text-dark-blue bg-light-blue badge-pill px-3 mb-3 ml-1">
                                                    Payment Method
                                                </div>
                                                <div id="card-element" style="width:100%;">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>

                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            <div class="form-row justify-content-left py-3">
                                                <div class="badge badge-primary text-dark-blue bg-light-blue badge-pill px-3 mb-1 ml-1">
                                                    E-mail Address
                                                </div>
                                                <div class="input-group">
                                                <span class="input-group-addon ml-1"><i
                                                            class="fa fa-fw fa-envelope text-dark"></i></span>
                                                    <input v-on:input="changed()" type="text"
                                                           class="form-control mr-1" placeholder="E-mail..."
                                                           name="email"
                                                           @if(\Auth::user()) value="{{ \Auth::user()->email }}" @endif
                                                           value="{{ old('name') }}" required autofocus
                                                           @if(\Auth::user()) disabled @endif>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="w-100 d-block pr-md-0 pb-2" align="center" id="subscribeApp">
                                    <div  v-if="status == 'loaded' && info.hasOwnProperty('meta') == false">
                                        <button class="btn btn-lg btn-pill btn-default btn-outline-success mt-3 mr-4 mb-4 toggleVisibility" style="float:right;" v-bind:class="{ visible: status == 'loaded'}"  v-on:click="submit">
                                            Continue<i
                                                    class="fas fa-xs fa-chevron-right ml-2"></i>
                                        </button>
                                    </div>
                                    <div v-else >
                                        <div v-if="status == 'loading' && info.errors == null" >
                                            <i class="fa fa-fw fa-spinner fa-spin animate mr-2"></i>Loading...
                                        </div>
                                        <div class="bg-white p-4 br-5 p-4 margin-top-72-large raised toggleVisibility " v-bind:class="{ visible: info.hasOwnProperty('meta') == true,  'd-block': info.hasOwnProperty('meta') == true}"   v-else-if="status == 'loaded' && info.hasOwnProperty('meta') == true && info.meta.status == 'success'">
                                            <i class="fa fa-fw fa-check-circle text-success mr-2"></i>Success! You have subscribed to {{ $product->name }}. You may manage your subscriptions in <a href="/app/subscriptions">My Subscriptions</a>.
                                        </div>
                                        <div class="bg-white br-5 p-4 margin-top-72-large raised toggleVisibility " v-bind:class="{ visible: info.errors != null, 'd-block': info.errors != null}"  v-else-if="info.errors != null" >
                                            <i class="fa fa-fw fa-exclamation-circle text-danger mr-2"></i> Something went wrong. Reload the page and try again.
                                        </div>
                                        <div class="bg-white br-5 p-4 margin-top-72-large raised toggleVisibility " v-bind:class="{ visible: info.hasOwnProperty('meta') == true, 'd-block': info.hasOwnProperty('meta') == true}"  v-else >
                                            <i class="fa fa-fw fa-exclamation-circle text-danger mr-2"></i> Something went wrong. Reload the page and try again.
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </main>
@endsection

@section('scripts')


    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ stripeKey() }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });


        function getToken(){
            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        }

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            getToken();
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            console.log(token.id);

            // Submit the form
                    @if(\Auth::user())
            var userId = '{{ \Auth::user()->stripe_id }}';
            @endif
            stripeApp.updatePayload({token: token, userId: userId});
            //form.submit();

        }
    </script>

    <script>
        var stripeApp = new Vue({
            el: '#subscribeApp',
            data: {
                info: {},
                payload: {},
                hasErrors: false,
                status: 'loading'
            },
            methods: {
                submit(){
                    getToken();
                },
                onSubmit(input) {
                    console.log('test');
                    console.log(input);
                },
                updateInfo(info) {
                    this.info = info;
                    if (this.info.meta.status == 'success') {
                        $("#lastFour").text(this.payload.token.card.last4);
                        $("#card-element").hide();
                        $("#subscribeForm").addClass('status-success');
                    }
                    if (this.info.meta.status == 'error') {
                        $("#subscribeForm").addClass('status-error');
                    }

                    this.status = 'loaded';
                },
                updatePayload(payload) {
                    this.payload = payload;
                    //console.log(this.payload);
                    this.addSubscription();
                    $("#formCard").hide();
                },
                addSubscription() {
                    this.status = 'loading';
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url = '/api/resources/product/{{ $product->id }}/transformation?action={{ $plan->stripe_id }}&transformation=Subscribe&user_id={{ \Auth::user()->id }}';
                    payload = {data: this.payload};
                    axiosConfig = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache',
                            "Access-Control-Allow-Origin": "*"
                        }
                    };
                    axios({
                        method: 'post',
                        url: url,
                        headers: axiosConfig,
                        data: payload
                    }).then(response => (this.updateInfo(response.data))
                )
                    ;
                }
            },
            mounted() {
                this.status = 'loaded';
            }
        });
    </script>

@endsection