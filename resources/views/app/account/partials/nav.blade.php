<ul class="list-group">
    <a href="/app/account"  class="pl-3 list-group-item text-dark bg-very-light-blue-alt-when-active  bg-very-light-blue-when-hovering {{ Request::is('app/account') ? 'active' : '' }}"><i class="fa fa-fw fa-angle-right place-indicator mr-2"></i><i class="material-icons mr-3">person</i>Profile</a>
    <a href="/app/settings"  class="pl-3 list-group-item text-dark bg-very-light-blue-alt-when-active bg-very-light-blue-when-hovering {{ Request::is('app/settings*') ? 'active' : '' }}"><i class="fa fa-fw fa-angle-right place-indicator mr-2"></i><i class="material-icons mr-3">settings</i>Settings</a>
    <a href="/app/products"  class="pl-3 list-group-item bg-very-light-blue-alt-when-active text-dark bg-very-light-blue-when-hovering {{ Request::is('app/products*') ? 'active' : '' }}"><i class="fa fa-fw fa-angle-right place-indicator  mr-2"></i><i class="material-icons mr-3">shopping_cart</i>Products</a>
    <a href="/app/payment"  class="pl-3 list-group-item text-dark bg-very-light-blue-alt-when-active bg-very-light-blue-when-hovering {{ Request::is('app/payment') ? 'active' : '' }}"><i class="fa fa-fw fa-angle-right place-indicator mr-2"></i><i class="material-icons mr-3">credit_card</i>Payments</a>
    <a href="/app/subscriptions"  class="pl-3 list-group-item bg-very-light-blue-alt-when-active text-dark bg-very-light-blue-when-hovering {{ Request::is('app/subscriptions*') ? 'active' : '' }}"><i class="fa fa-fw fa-angle-right place-indicator  mr-2"></i><i class="material-icons mr-3">subscriptions</i><span class="d-none d-lg-inline-block d-md-none d-sm-none ">Subscriptions</span><span class="d-md-inline-block d-lg-none">Plans</span></a>
</ul>