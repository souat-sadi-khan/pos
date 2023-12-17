@if (Request::is('admin/point-of-sell'))
    
@else 
<aside class="main-sidebar control-sidebar-dark text-sm">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="{{ get_option('logo') && get_option('logo') != '' ? asset('storage/images/logo'). '/'. get_option('logo') : asset('images/logo.png') }}"
            alt="Brand Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span
            class="brand-text font-weight-light">{{get_option('site_title') && get_option('site_title') != '' ? substr(get_option('site_title'), 0, 10) : 'Sadik'}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (Auth::user()->image != 'user.png' ? asset('storage/images/user'. '/'. Auth::user()->image) : asset('images/user.png')) }}" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact nav-flat" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{Request::is('home') ? 'active':''}}">
                        <i class="nav-icon fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.point-of-sell') }}" class="nav-link {{Request::is('admin/point-of-sell') ? 'active':''}}">
                        <i class="nav-icon fa fa-sellsy"></i>
                        <p>POINT OF SELL</p>
                    </a>
                </li>

                @can('product_initialize.view')
                    {{-- Product Initialize --}}
                    <li class="nav-item has-treeview {{ Request::is('admin/product-initiazile*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ Request::is('admin/product-initiazile*') ? 'active' : '' }} ">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Product Initialize
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('category.view')
                                {{-- Category --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.category.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/category') ? 'active' : '' }}">
                                        <i class="fa fa-cart-plus nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            @endcan

                            @can('brand.view')
                                {{-- Brand --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.brand.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/brand') ? 'active' : '' }}">
                                        <i class="fa fa-bold nav-icon"></i>
                                        <p>Brand</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('unit.view')
                                {{-- Unit --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.unit.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/unit') ? 'active' : '' }}">
                                        <i class="fa fa-underline nav-icon"></i>
                                        <p>Unit</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('box.view')
                                {{-- Box --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.box.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/box') ? 'active' : '' }}">
                                        <i class="fa fa-archive nav-icon"></i>
                                        <p>Box</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('taxrate.view')
                                {{-- TaxRate --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.taxrate.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/taxrate') ? 'active' : '' }}">
                                        <i class="fa fa-usd nav-icon"></i>
                                        <p>TaxRate</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('size.view')
                                {{-- Size --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.size.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/size') ? 'active' : '' }}">
                                        <i class="fa fa-scribd nav-icon"></i>
                                        <p>Size</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('color.view')
                                {{-- Color --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.color.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/color') ? 'active' : '' }}">
                                        <i class="fa fa-creative-commons nav-icon"></i>
                                        <p>Color</p>
                                    </a>
                                </li>
                            @endcan 

                            @can('payment_method.view')
                                {{-- Payment Method --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-initiazile.payment-method.index') }} " class="nav-link {{ Request::is('admin/product-initiazile/payment-method') ? 'active' : '' }}">
                                        <i class="fa fa-paypal nav-icon"></i>
                                        <p>Payment Method</p>
                                    </a>
                                </li>
                            @endcan 

                        </ul>
                    </li>
                @endcan

                @can('product_section.view')
                    {{-- Product Section --}}
                    <li class="nav-item has-treeview {{ Request::is('admin/products*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }} ">
                            <i class="nav-icon fa fa-star"></i>
                            <p>
                                Products
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('product.view')
                                {{-- Product List --}}
                                <li class="nav-item">
                                <a href="{{ route('admin.products.products.index', 'show=list') }} " class="nav-link {{ isset($product_sidebar) && $product_sidebar == 'list' ? 'active' : '' }}">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Product List</p>
                                    </a>
                                </li>

                                {{-- Product Add --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.products.index', 'show=create') }} " class="nav-link {{ isset($product_sidebar) && $product_sidebar == 'create' ? 'active' : '' }}">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Create Product</p>
                                    </a>
                                </li>
                            @endcan

                            @can('product.import')
                                {{-- Product Import --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.products.import') }} " class="nav-link {{ Request::is('admin/products/import-products') ? 'active' : '' }}">
                                        <i class="fa fa-upload nav-icon"></i>
                                        <p>Import Products</p>
                                    </a>
                                </li>
                            @endcan

                            @can('product.import')
                                {{-- Product Stock Alert --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.stock_alert') }} " class="nav-link {{ Request::is('admin/products/stock-alert') ? 'active' : '' }}">
                                        <i class="fa fa-exclamation-triangle nav-icon"></i>
                                        <p>Stock Alert</p>
                                    </a>
                                </li>
                            @endcan
                           
                        </ul>
                    </li>
                @endcan

                @can('product_purchase.view')
                {{-- Product Purchase Secion --}}
                    <li class="nav-item has-treeview {{ Request::is('admin/purchase*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ Request::is('admin/purchase*') ? 'active' : '' }} ">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>
                                Purchase
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('purchase.view')
                                {{-- Purchase List --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchase.index', 'show=list') }} " class="nav-link {{ isset($purchase_sidebar) && $purchase_sidebar == 'list' ? 'active' : '' }}">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Purchase List</p>
                                    </a>
                                </li>

                                {{-- Purchase Create --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchase.index', 'show=create') }} " class="nav-link {{ isset($purchase_sidebar) && $purchase_sidebar == 'create' ? 'active' : '' }}">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Create Purchase</p>
                                    </a>
                                </li>

                                {{-- Due Invoice --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchase.due_invoice') }} " class="nav-link {{Request::is('admin/purchase/due-purchase-invoice') ? 'active':''}}">
                                        <i class="fa fa-cc-jcb nav-icon"></i>
                                        <p>Due Invocie</p>
                                    </a>
                                </li>
                            @endcan
                        
                        </ul>
                    </li>
                @endcan

                @can('customer.view')
                    {{-- Customer --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.customer.index') }}" class="nav-link {{Request::is('admin/customer*') ? 'active':''}}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                @endcan

                @can('supplier.view')
                    {{-- Supplier --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.supplier.index') }}" class="nav-link {{Request::is('admin/supplier*') ? 'active':''}}">
                            <i class="nav-icon fa fa-truck"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                @endcan

                @can('accounting.view')
                <li class="nav-item has-treeview {{ Request::is('admin/account*') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ Request::is('admin/account*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            Accounting
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.account.bank-account.index', 'show=create') }} " class="nav-link {{ isset($bank_account_sidebar) && $bank_account_sidebar == 'create' ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Bank Account</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.account.bank-account.index', 'show=list') }} " class="nav-link {{ isset($bank_account_sidebar) && $bank_account_sidebar == 'list' ? 'active' : '' }}">
                                <i class="fa fa-sign-in nav-icon"></i>
                                <p>Bank Account List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.account.diposit.index') }} " class="nav-link {{ Request::is('admin/account/diposit') ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Diposit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.general.dashboard') }} " class="nav-link {{ Request::is('admin/settings/dashboard') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Withdraw</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.login') }} " class="nav-link {{ Request::is('admin/settings/login') ? 'active' : '' }}">
                                <i class="fa fa-sign-in nav-icon"></i>
                                <p>Transaction List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.settings') }} " class="nav-link {{ Request::is('admin/settings/general') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Transfer List</p>
                            </a>
                        </li>
                        

                        <li class="nav-item">
                            <a href="{{ route('admin.general.settings') }} " class="nav-link {{ Request::is('admin/settings/general') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Income Source</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.general.dashboard') }} " class="nav-link {{ Request::is('admin/settings/dashboard') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Balance Sheet</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.login') }} " class="nav-link {{ Request::is('admin/settings/login') ? 'active' : '' }}">
                                <i class="fa fa-sign-in nav-icon"></i>
                                <p>Income MonthWise</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.settings') }} " class="nav-link {{ Request::is('admin/settings/general') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Expense MonthWise</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.general.dashboard') }} " class="nav-link {{ Request::is('admin/settings/dashboard') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Income vs Expense</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.login') }} " class="nav-link {{ Request::is('admin/settings/login') ? 'active' : '' }}">
                                <i class="fa fa-sign-in nav-icon"></i>
                                <p>Profit vs Loss</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('expenditure.view')
                <li class="nav-item has-treeview {{ Request::is('admin/expense*') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ Request::is('admin/expense*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-minus"></i>
                        <p>
                            Expense
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.expense.index', 'show=create') }} " class="nav-link {{ isset($expense) && $expense == 'create' ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Expense</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.expense.index', 'show=list') }} " class="nav-link {{ isset($expense) && $expense == 'list' ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Expense List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.expense-category.index', 'show=create') }} " class="nav-link {{ isset($expense_category) && $expense_category == 'create' ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.expense-category.index', 'show=list') }} " class="nav-link {{ isset($expense_category) && $expense_category == 'list' ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.expense_summer') }} " class="nav-link {{ Request::is('admin/expense/expens-summery') ? 'active' : '' }}">
                                <i class="fa fa-film nav-icon"></i>
                                <p>Summery</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- Loan Manage --}}
                <li class="nav-item has-treeview {{ Request::is('admin/loan*') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ Request::is('admin/loan*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-tasks"></i>
                        <p>
                            Loan Manage
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.loan.index') }} " class="nav-link {{ Request::is('admin/loan') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Loan List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.loan.summery') }} " class="nav-link {{ Request::is('admin/loan/summery') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Summary</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Settings --}}
                <li class="nav-item has-treeview {{ Request::is('admin/settings*') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.general.settings') }} " class="nav-link {{ Request::is('admin/settings/general') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>General Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.general.dashboard') }} " class="nav-link {{ Request::is('admin/settings/dashboard') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Dashboard Settings</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.general.login') }} " class="nav-link {{ Request::is('admin/settings/login') ? 'active' : '' }}">
                                <i class="fa fa-sign-in nav-icon"></i>
                                <p>Login Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- User Manage --}}
                {{-- <li class="nav-item has-treeview {{ Request::is('admin/user*') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-user-times"></i>
                        <p>
                            User Manage
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.role') }} " class="nav-link {{ Request::is('admin/user/role') ? 'active' : '' }}">
                                <i class="fa fa-stop-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@endif