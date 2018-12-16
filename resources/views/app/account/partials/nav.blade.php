<ul class="list-group">
    <a href="/app/account"  class="list-group-item text-dark {{ Request::is('app/account') ? 'active' : '' }}"><i class="material-icons mr-2">person</i>Profile</a>
    <a href="/app/payment"  class="list-group-item text-dark {{ Request::is('app/payment') ? 'active' : '' }}"><i class="material-icons mr-2">credit_card</i>Payment Details</a>
    <a href="/app/subscriptions"  class="list-group-item text-dark {{ Request::is('app/subscriptions') ? 'active' : '' }}"><i class="material-icons mr-2">subscriptions</i>Subscriptions</a>
    <a href="/app/preferences"  class="list-group-item text-dark {{ Request::is('app/preferences') ? 'active' : '' }}"><i class="material-icons mr-2">settings</i>Preferences</a>
</ul>