<!-- Header -->
<header id="wn__header" class="oth-page header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <span style="display: block; color:#fff; font-weight:bold; font-size:28px;   white-space: nowrap; ">My <span style="color: #f39c12">Blog</span></span>

                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('our-vision') }}">Our Vission</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li class="drop"><a href="#">Categories</a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    @forelse ($global_categories as $category )
                                    <li><a href="{{ route('category.show' , $category->slug)}}">{{ $category->title }}</a></li>
                                    @empty

                                  @endforelse

                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>

                    <li class="shopcart"><a class="cartbox_active" href="#"><span class="product_qun">3</span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">


                                <div class="single__items">
                                    <div class="miniproduct">

                                        <div class="item01 d-flex align-items-center mt--20">
                                            <div class="thumb">
                                                <a href="product-details.html"><img src="{{ asset('uploads/posts_media/default.small.png')    }}" alt="product images"></a>
                                            </div>
                                            <div class="content">
                                                <h6><a href="product-details.html">You have new Notifications </a></h6>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">

                                <div class="switcher-currency">

                                    <strong class="label switcher-label">
                                        <span>

                                            @if (Auth::check())
                                            Welcome {{ explode(" " , Auth::user()->name)[0] }}
                                            @else
                                            Welcome there
                                            @endif
                                        </span>
                                    </strong>

                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <div class="setting__menu">

                                                @if (Auth::check())
                                                  <span><a href="{{ route('user.dashboard','#posts') }}">My Dashboard</a></span>
                                                  <span><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"
                                                    >Log Out</a></span>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                @else

                                                    <span><a href="{{ route('login') }}">Login In</a></span>



                                                    <span><a href="{{ route('register') }}">Create An Account</a></span>



                                                @endif

                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('our-vision') }}">Our Vission</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="#">Categories</a>
                            <ul>
                                @forelse ($global_categories as $category )
                                <li><a href="{{ route('category.show' , $category->slug)}}">{{ $category->title }}</a></li>
                                @empty

                                @endforelse


                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>
<!-- //Header -->
<!-- Start Search Popup -->
<div class="box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="{{ route('home') }}">
        <div class="field__search">
            <input type="text" name="search" placeholder="Search in all posts ...">
            <div class="action">
                <button type="submit"><i class="zmdi zmdi-search"></i></button>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--4 "  id="bradcaump">

</div>
<!-- End Bradcaump area -->
