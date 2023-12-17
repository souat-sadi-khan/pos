<ul class="customer-list list-unstyled">
    @foreach ($customers as $item)
        <li ng-repeat="customers in customerArray" class="ng-scope">
            <a class="select_customer" data-id="{{$item->id }}" href="#"><span class="fa fa-fw fa-user"></span>{{$item->customer_name }} ({{$item->customer_mobile}})
            </a>
        </li>
    @endforeach
</ul>