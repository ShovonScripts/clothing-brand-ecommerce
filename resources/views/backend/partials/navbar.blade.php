<li class="side-nav-label">Main</li>
<li class="side-nav-item dashboard">
    <a href="{{ route('admin.dashboard') }}" class="side-nav-link d-block text-center">
        <i class="mdi mdi-view-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>

@if(auth()->user()->can('order.view') || auth()->user()->can('permission.view'))
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders" class="side-nav-link">
        <i class="mdi mdi-cart-outline"></i>
        <span>Orders</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="orders">
        <ul class="side-nav-second-level">
           @if(auth()->user()->can('order.view'))
            @foreach(getOrderStatus(1) as $key=> $item)
            <li>
                <a href="{{ url('admin/orders?q=&status='.$key) }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>{{ $item }} Orders</span>
                </a>
            </li>
           @endforeach
           @endif
        </ul>
    </div>        
</li>
@endif

<li class="side-nav-label">Catalog</li>

@if(auth()->user()->can('product.view') || auth()->user()->can('type.view') || auth()->user()->can('size.view') || auth()->user()->can('category.view') || auth()->user()->can('discount.view') || auth()->user()->can('color.view') || auth()->user()->can('combo.view'))
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products" class="side-nav-link">
        <i class="mdi mdi-package-variant"></i>
        <span>Products</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="products">
        <ul class="side-nav-second-level">
           @if(auth()->user()->can('type.view'))
            <li class="">
                <a href="{{ route('admin.types.index') }}" class="">
                    <i class="mdi mdi-tag-outline"></i>
                    <span>Brands</span>
                </a>
            </li>
           @endif
       
            @if(auth()->user()->can('category.view'))
            <li class="">
                <a href="{{ route('admin.categories.index') }}" class="">
                    <i class="mdi mdi-folder-outline"></i>
                    <span>Categories</span>
                </a>
            </li>
          @endif
           
            @if(auth()->user()->can('size.view'))
            <li class="">
                <a href="{{ route('admin.sizes.index') }}" class="">
                    <i class="mdi mdi-ruler"></i>
                    <span>Sizes</span>
                </a>
            </li>
           @endif
            @if(auth()->user()->can('size.view'))
            <li class="">
                <a href="{{ route('admin.weights.index') }}" class="">
                    <i class="mdi mdi-weight-kilogram"></i>
                    <span>Weights</span>
                </a>
            </li>
           @endif
			
            @if(auth()->user()->can('color.view'))
            <li class="">
                <a href="{{ route('admin.colors.index') }}" class="">
                    <i class="mdi mdi-palette-outline"></i>
                    <span>Colors</span>
                </a>
            </li>
          @endif
       
            @if(auth()->user()->can('product.view'))
            <li class="">
                <a href="{{ route('admin.products.index') }}" class="">
                    <i class="mdi mdi-tshirt-crew"></i>
                    <span>Products</span>
                </a>
            </li>
          @endif
           
            @if(auth()->user()->can('discount.view'))
            <li class="">
                <a href="{{ route('admin.product_discounts.index') }}" class="">
                    <i class="mdi mdi-percent-box-outline"></i>
                    <span>Discounts</span>
                </a>
            </li>
          @endif
           
            @if(auth()->user()->can('combo.view'))
            <li class="">
                <a href="{{ route('admin.combos.index') }}" class="">
                    <i class="mdi mdi-package-variant-closed"></i>
                    <span>Combo Offers</span>
                </a>
            </li>
          @endif

            <li class="">
                <a href="{{ route('admin.free_shipping') }}" class="">
                    <i class="mdi mdi-truck-delivery"></i>
                    <span>Free Shipping</span>
                </a>
            </li>
            
            <li class="">
                <a href="{{ route('admin.landing_pages.index') }}" class="">
                    <i class="mdi mdi-web"></i>
                    <span>Landing Pages</span>
                </a>
            </li>
       
        </ul>
    </div>
</li>
@endif   


@if(auth()->user()->can('purchase.view'))
   <li class="side-nav-item">
    <a href="{{ route('admin.purchase.index') }}" class="side-nav-link">
      <i class="mdi mdi-cart-plus"></i>
      <span>Purchases</span>
    </a>
   </li>  
@endif    


<li class="side-nav-label">Content</li>

@if(auth()->user()->can('page.view') || auth()->user()->can('image.view') || auth()->user()->can('slider.view') || auth()->user()->can('career.view') || auth()->user()->can('about_us.view'))
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#front_page" aria-expanded="false" aria-controls="front_page" class="side-nav-link">
        <i class="mdi mdi-home-outline"></i>
        <span>Front Page</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="front_page">
        <ul class="side-nav-second-level">
                     
            @if(auth()->user()->can('page.view'))	
            <li class="">
                <a href="{{ route('admin.pages.index') }}" class="">
                    <i class="mdi mdi-file-document-outline"></i>
                    <span>Pages</span>
                </a>
            </li>
            @endif
                 	
            @if(auth()->user()->can('slider.view'))	
            <li class="">
                <a href="{{ route('admin.sliders.index') }}" class="">
                    <i class="mdi mdi-image-filter-frames"></i>
                    <span>Sliders</span>
                </a>
            </li>
            @endif
             
            @if(auth()->user()->can('image.view'))	
            <li class="">
                <a href="{{ route('admin.home_section_images.index') }}" class="">
                    <i class="mdi mdi-image-multiple"></i>
                    <span>Home Sections</span>
                </a>
            </li>
            @endif
            
            @if(auth()->user()->can('image.view'))	
            <li class="">
                <a href="{{ route('admin.social_icons.index') }}" class="">
                    <i class="mdi mdi-share-variant-outline"></i>
                    <span>Social Icons</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->can('career.view'))
            <li class="">
                <a href="{{ route('admin.career.index') }}" class="">
                    <i class="mdi mdi-briefcase-outline"></i>
                    <span>Careers</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->can('about_us.view'))
            <li class="">
                <a href="{{ route('admin.about_us.index') }}" class="">
                    <i class="mdi mdi-information-outline"></i>
                    <span>About Us</span>
                </a>
            </li>
            @endif
     
        </ul>
    </div>
</li>
@endif


@if(auth()->user()->can('coupon_codes.view'))
<li class="side-nav-item">
    <a href="{{ route('admin.coupon_codes.index') }}" class="side-nav-link">
        <i class="mdi mdi-ticket-percent"></i>
        <span>Coupons</span>
    </a>
</li> 
@endif
	
@if(auth()->user()->can('delivery_charge.view'))
<li class="side-nav-item">
    <a href="{{ route('admin.delivery_charge.index') }}" class="side-nav-link">
        <i class="mdi mdi-truck-delivery-outline"></i>
        <span>Delivery Charges</span>
    </a>
</li> 
@endif


@if(auth()->user()->can('couriers.view'))
<li class="side-nav-item">
    <a href="{{ route('admin.couriers.index') }}" class="side-nav-link">
        <i class="mdi mdi-truck-fast-outline"></i>
        <span>Couriers</span>
    </a>
</li> 
@endif
      


<li class="side-nav-label">System</li>

@if(auth()->user()->can('user.view') || auth()->user()->can('permission.view') || auth()->user()->can('role.view'))
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user" class="side-nav-link">
        <i class="mdi mdi-account-group-outline"></i>
        <span>Users & Access</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="user">
        <ul class="side-nav-second-level">
           @if(auth()->user()->can('user.view'))
            <li>
                <a href="{{ route('admin.users.index') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Users</span>
                </a>
            </li>
           @endif
            @if(auth()->user()->can('permission.view'))
            <li>
                <a href="{{ route('admin.permissions.index') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Permissions</span>
                </a>
            </li>
           @endif
           	
           @if(auth()->user()->can('role.view'))
            <li>
                <a href="{{ route('admin.roles.index') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Roles</span>
                </a>
            </li>
           @endif
        </ul>
    </div>
</li>
@endif

@if(auth()->user()->can('order.view') || auth()->user()->can('permission.view'))
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports" class="side-nav-link">
        <i class="mdi mdi-chart-bar"></i>
        <span>Reports</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="reports">
        <ul class="side-nav-second-level">
           @if(auth()->user()->can('order.view'))
            <li>
                <a href="{{ route('admin.report.order') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Order Report</span>
                </a>
            </li>
           @endif
<li>
                <a href="{{ route('admin.ipblock') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Blocked IPs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.product') }}" class="">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Product Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
@endif


@if(auth()->user()->can('permission.view'))
<li class="side-nav-item">
    <a href="{{ route('admin.settings.index') }}" class="side-nav-link">
        <i class="mdi mdi-cog-outline"></i>
        <span>Settings</span>
    </a>
</li>
@endif