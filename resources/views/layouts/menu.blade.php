{{--<li class="{{ Request::is('admin/countries*') ? 'active' : '' }}">
    <a href="{{ route('countries.index') }}"><i class="fa fa-flag" aria-hidden="true"></i>
        <span>Countries</span></a>
</li>--}}

{{--<li class="{{ Request::is('admin/provinces*') ? 'active' : '' }}">
    <a href="{{ route('provinces.index') }}"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Provinces</span></a>
</li>--}}

{{--<li class="{{ Request::is('admin/cities*') ? 'active' : '' }}">
    <a href="{{ route('cities.index') }}"><i class='fa fas fa-city' style='font-size:13px' aria-hidden="true"></i><span>Cities</span></a>
</li>--}}

{{--<li class="{{ Request::is('companies*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('companies.index') }}"><i class=' fa fas fa-briefcase'  aria-hidden="true"></i><span>Companies</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('admin/webUsers*') ? 'active' : '' }}">
    <a href="{{ route('webUsers.index') }}"><i class="fa fas fa-user" aria-hidden="true"></i><span>Web  Users</span></a>
</li>

<li class="{{ Request::is('admin/drivers*') ? 'active' : '' }}">
    <a href="{{ route('drivers.index') }}"><i class="fa fa-hdd-o" aria-hidden="true"></i><span>Drivers</span></a>
</li>

<li class="{{ Request::is('admin/deliveryAddresses*') ? 'active' : '' }}">
    <a href="{{ route('deliveryAddresses.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i><span>New Request</span></a>
</li>

<li class="{{ Request::is('admin/assignDrivers*') ? 'active' : '' }}">
    <a href="{{ route('assignDrivers.index') }}"><i class="fa fa-users" aria-hidden="true"></i>Assign Drivers</span></a>
</li>

<li class="{{ Request::is('admin/deliveryCompletions*') ? 'active' : '' }}">
    <a href="{{ route('deliveryCompletions.index') }}"><i class="fa fa-truck" aria-hidden="true"></i><span>Complete Deliveries</span></a>
</li>

<li class="{{ Request::is('admin/pendingDeliveries*') ? 'active' : '' }}">
    <a href="{{ route('pendingDeliveries.index') }}"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Pending Deliveries</span></a>
</li>

<li class="{{ Request::is('admin/driverReviews*') ? 'active' : '' }}">
    <a href="{{ route('driverReviews.index') }}"><i class="fa fa-comments"></i><span>Driver Reviews</span></a>
</li>

<li class="{{ Request::is('admin/userReviews*') ? 'active' : '' }}">
    <a href="{{ route('userReviews.index') }}"><i class="fa fa-comments"></i><span>User Reviews</span></a>
</li>

{{--<li class="{{ Request::is('transactions*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('transactions.index') }}"><i class="fa fa-edit"></i><span>Transactions</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('tempDeliveryAddresses*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('tempDeliveryAddresses.index') }}"><i class="fa fa-edit"></i><span>Temp Delivery Addresses</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('tempPackages*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('tempPackages.index') }}"><i class="fa fa-edit"></i><span>Temp Packages</span></a>--}}
{{--</li>--}}
<li class="{{ Request::is('carMakes*') ? 'active' : '' }}">
    <a href="{{ route('carMakes.index') }}"><i class="fa fa-industry"></i><span>Car Makes</span></a>
</li>



<li class="{{ Request::is('carModels*') ? 'active' : '' }}">
    <a href="{{ route('carModels.index') }}"><i class="fa fa-tasks"></i><span>Car Models</span></a>
</li>


<script src='https://kit.fontawesome.com/a076d05399.js'></script>



