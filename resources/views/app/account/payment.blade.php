@extends('layouts.shards_frontend')

@section('php-variables')
    <?php $viewOptions['splash-height'] = '300px'; ?>
@endsection

@section('title')
    Account
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('css')
    <style>
        .avatar-large {
            height: 50px;
            width: 50px;
            border-radius: 50px;
            display: inline-block;
            background: url('{{ \Auth::user()->avatar() }}');
            background-size: cover;
            background-position: center;
        }

        .card.border {
            border-color: #cfd8e2 !important;
        }

        .card-header {
            background: #fff !important;
        }

        .card {
            height: auto !important;
            min-height: auto !important;
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

        #stripeApp .btn-success{
            display:none;
        }

        #stripeApp .btn-danger{
            display:none;
        }

        #stripeApp.status-success .btn-success {
            display:inline-block;
        }

        #stripeApp.status-error .btn-danger {
            display:inline-block;
        }

    </style>
@endsection

@section('navbar-classes')
    dark
@endsection

@section('splash-class')
    minimal
@endsection


@section('content')
    <!-- Related Content Section -->
    <div class="blog section section-invert pt-4 pb-0" style="min-height:calc(100vh - 133px) !important;">
        <h4 class="section-title text-center mb-5 mt-3">My Account</h4>

        <div class="container">
            <div class="row pt-2">
                <div class="pt-0 mb-3 col-md-3 pull-left">
                    @include('app.account.partials.nav')
                </div>
                <div class="pt-0 mb-3 col-md-9">
                    <div class="card mb-3"  id="stripeApp">
                        <div class="card-header border-bottom text-center"><i class="material-icons text-primary dimmed  mr-2">credit_card</i>Payment Method</div>
                        <div class="card-body">
                            @if(\Auth::user()->card_last_four != null)
                                <p class="card-text">Card on file ends in&nbsp;
                                    <strong id="lastFour">{{ \Auth::user()->card_last_four }}</strong></p>
                            @endif

                            <form v-on:submit.prevent="onSubmit" id="payment-form" class="mb-0"
                                  style="width:100%; text-align:right;">
                                <div class="form-row justify-content-center">

                                    <div id="card-element" style="width:100%;">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                                <button class="btn btn-primary mt-2 pull-right" v-if="info.data == null">Update Payment
                                    Details
                                </button>
                                <div v-else>
                                    <div v-if="info.data.meta != null && info.data.meta.status != null && info.data.meta.status == 'success'"
                                         class="btn btn-success disabled mt-2 text-dark pull-right">
                                        <i class="fa fa-check-circle mr-2"></i>Success!
                                    </div>
                                    <button v-else-if="info.data.meta != null && info.data.meta.status != null && info.data.meta.status == 'errir'"
                                            class="btn btn-danger mt-2 pull-right">
                                        Try Again
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="w-100" id="paymentsApp" v-if="info != null">
                        <?php $nowString = \Carbon\Carbon::now()->toDateString(); ?>
                        <?php $header = '
                        <h6 class="mb-0"><i class="fa fa-fw fa-history mr-2 dimmed text-primary"></i>Payment History</h6>'; ?>
                        <?php $tableRow = '<td align="left" class="text-capitalize align-middle pl-4"><span class="badge badge-light text-dark mx-2">{{ item.amount }} {{ item.currency }}</span><span class="badge badge-light text-dark hiddenOnMobile mr-2">{{ moment(item.updated_at, "YYYYMMDD").fromNow()  }}</span><span class="badge text-dark my-2">{{ item.description }}</span></td>'; ?>
                        {!! renderResourceTableHtmlDynamically(['HEADER' => $header,  'TABLE_ROW' => $tableRow, 'PATH' => '/admin/product', 'WRAPPER_CLASS' => '']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderStripeAppJs() !!}
    <script>
        userId = {{ \Auth::user()->id }};
    </script>
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

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

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
            stripeApp.updatePayload({token: token, userId: userId});
            //form.submit();

        }
    </script>

    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'paymentsApp', 'div_id' => 'paymentsApp', 'url' => '/api/resources/payment', 'FILTERS' => "{'user_id':'user_id=".\Auth::user()->id."',    'status':'ends_at>=".$nowString."'}"]) !!}
@endsection