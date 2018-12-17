<ul class="list-group">
    <a href="/app/account"  class="list-group-item text-dark {{ Request::is('app/account') ? 'active' : '' }}"><i class="material-icons mr-2">person</i>Profile</a>
    <a href="/app/preferences"  class="list-group-item text-dark {{ Request::is('app/preferences') ? 'active' : '' }}"><i class="material-icons mr-2">settings</i>Settings</a>
    <a href="/app/payment"  class="list-group-item text-dark {{ Request::is('app/payment') ? 'active' : '' }}"><i class="material-icons mr-2">credit_card</i>Payments</a>
    <a href="/app/subscriptions"  class="list-group-item text-dark {{ Request::is('app/subscriptions') ? 'active' : '' }}"><i class="material-icons mr-2">subscriptions</i><span class="d-none d-lg-inline-block d-md-none d-sm-none ">Subscriptions</span><span class="d-md-inline-block d-lg-none">Plans</span></a>
</ul>