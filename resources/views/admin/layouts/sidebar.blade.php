@php
$Title = isset($pageTitle) ? $pageTitle : trans('admin.home');
$pageTitle = $Title;
@endphp

<style>
  .navigation-main {
    display: flex;
    height: auto;
    flex-direction: row;
    padding: 5px 0;
    margin: 0;
    align-items: center;
  }

  .main-menu .main-menu-content {
    height: auto !important;
    width: 100%;
    z-index: 3000000;
  }

  body.vertical-layout.vertical-menu.menu-expanded .main-menu {
    width: 100%;
    height: auto;
  }

  body.vertical-layout.vertical-menu.menu-expanded .content {
    margin-right: 0 !important;
  }


  body.vertical-layout.vertical-menu.menu-expanded .main-menu .navigation>li>a>.icon {
    /* display: block; */
    text-align: center;
    font-size: 17px;
  }

  body.vertical-layout.vertical-menu.menu-expanded .main-menu .navigation li.has-sub>a:not(.mm-next):after {
    display: none
  }

  .main-menu.menu-dark .navigation>li>a {
    font-size: 11px
  }

  .main-menu.menu-dark .navigation>li {
    margin-top: 0 !important
  }

  .main-menu.menu-dark .navigation {
    background: #fff;
    border-top: 2px solid #b71c1c;
  }

  .main-menu.menu-dark .navigation>li.open .hover>a {
    background: #b71c1c;
  }

  .main-menu.menu-dark .navigation>li>a {
    padding: 6px 14px;
  }

  .main-menu.menu-dark .navigation>li ul li>a {
    padding: 4px;
  }

  .main-menu-content .menu-content {
    position: fixed;
    z-index: 1000;
  }

  .content-body {
    margin-top: 50px;
  }

  .table {
    width: 100% !important;
  }

  @media only screen and (min-width:300px) and (max-width:780px) {
    .navigation-main {
      flex-direction: column
    }

    .main-menu.menu-dark .navigation>li>a {
      font-size: 15px
    }

    .vertical-overlay-menu .main-menu .navigation li.has-sub>a:not(.mm-next):after {
      display: none
    }

    .main-menu-content .menu-content {
      position: relative;
      width: 238px;
    }

    .navigation-main {
      align-items: baseline
    }

    .navigation li {
      margin-bottom: 10px
    }
  }

  .brand-logo {
    display: block;
    width: 185px;
    margin: auto;
    margin-top: -13px !important;
    height: 64px !important;
    ;
  }
strong.select2-results__group {
    color: #961d1d;
}
</style>

<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow no-print">

  <div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <li style="margin-top: 12px;" class=" nav-item {{ getActiveByVar($pageTitle, trans('admin.home')) }}"><a
          href="{{ route('admin.home') }}"><span class="icon"><i class="icon-home3"></i></span><span
            data-i18n="nav.dash.main" class="menu-title">{{ trans('admin.home') }}</span></a>
      </li>


      @can('pages.create', $userAuth)
      <!--  <li class=" nav-item"><a
        href="{{ route('warehouse.index') }}"><span class="icon"><i class="fa fa-building-o"></i></span><span data-i18n="nav.socials.main"
          class="menu-title">????????????????????</span></a>
    </li> -->
      @endcan


      @can('pages.create', $userAuth)
      <!-- <li class=" nav-item"><a
        href="{{ route('stock.index') }}"><span class="icon"><i class="fa fa-archive"></i></span><span data-i18n="nav.socials.main"
          class="menu-title">??????????????</span></a>
    </li> -->
      @endcan



      @can('settings.update', $userAuth)
      <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-map"></i></span><span
            data-i18n="nav.menu.main" class="menu-title">????????????????</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown">
            <a href="{{ route('visits.index') }}" class="menu-item">
              ?????? ????????????????
            </a>
          </li>
          <li class="is-shown" style="">
            <a href="{{ route('visits.create') }}" class="menu-item">
              ?????????? ?????????? ??????????
            </a>
          </li>
        </ul>
      </li>


      @endcan



      @can('sliders.create', $userAuth)
      <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-file-text"></i></span><span
            data-i18n="nav.menu.main" class="menu-title">???????? ??????????????</span></a>
        <ul class="menu-content" style="">

          <li class="is-shown" style="">
            <a href="{{ route('priceoffer.create') }}" class="menu-item">
              ?????????? ?????? ??????
            </a>
          </li>
          <li class="is-shown">
            <a href="{{ route('priceoffer.index') }}" class="menu-item">
              ???????? ?????????????? ?????????? ??????????
            </a>
          </li>
          <li class="is-shown">
            <a href="{{ route('admin.mooffer') }}" class="menu-item">
              ???????? ?????????????? ??????????????
            </a>
          </li>
          <li class="is-shown">
            <a href="{{ route('funds.index') }}" class="menu-item">
              ?????????????? ??????????
            </a>
          </li>
        </ul>
      </li>
      @endcan




      @can('menus.create', $userAuth)

      <li class=" nav-item"><a href="{{ route('preparations.index') }}"><span class="icon"><i
              class="fa fa-tasks"></i></span><span data-i18n="nav.socials.main" class="menu-title"> ?????????? ??????????????
          </span></a>
      </li>


      @endcan


      @can('pages.create', $userAuth)
      <li class=" nav-item"><a href="{{ route('delivery.index') }}"><span class="icon"><i
              class="fa fa-truck"></i></span><span data-i18n="nav.socials.main" class="menu-title"> ??????????
            ??????????????</span></a>
      </li>
      @endcan


      {{-- @can('socials.update', $userAuth)
    <li class=" nav-item"><a
        href="{{ route('admin.caroc-report.index') }}"><span class="icon"><i class="fa fa-file"></i></span><span
        data-i18n="nav.socials.main" class="menu-title">?????????? ???????????? </span></a>
      </li>
      @endcan --}}




      {{-- @if($userAuth->can('products.create') || $userAuth->can('product-categories.create') || $userAuth->can('users.create') || $userAuth->can('roles.create'))
    <li class="nav-item has-sub "><a href="#"><span class="icon"><i
          class="fa fa-product-hunt"></i></span><span data-i18n="nav.product.main" class="menu-title">????????????????</span></a>
      <ul class="menu-content" style="">
        @if($userAuth->can('products.create'))
        <li class="is-shown"><a href="{{ route('product.index') }}" class="menu-item">?????? ????????????????</a>
      </li>
      @endif
      @if($userAuth->can('roles.create'))
      <li class="is-shown"><a href="{{ route('parts.index') }}" class="menu-item">?????? ?????? ????????</a>
      </li>
      @endif

    </ul>
    </li>
    @endif --}}

    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-shopping-cart"></i></span><span
          data-i18n="nav.slider.main" class="menu-title"> ????????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('maintenance.create') }}" class="menu-item">???????????? ????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('maintenance.index') }}" class="menu-item">?????????? ????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('admin.sellsmnt.index') }}?main_type=1" class="menu-item">???????????? ?????? ????????????</a>
        </li>
      </ul>
    </li>

        <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-shopping-cart"></i></span><span
          data-i18n="nav.slider.main" class="menu-title"> ?????????????? ????????????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('maintenance.create') }}?main_type=2" class="menu-item">???????????? ?????????? ????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('maintenance.index') }}?main_type=2" class="menu-item">?????????? ?????????????? ????????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('admin.sellsmnt.index') }}?main_type=2" class="menu-item">???????????? ?????? ?????????????? ????????????????</a>
        </li>
      </ul>
    </li>

    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-shopping-cart"></i></span><span
          data-i18n="nav.slider.main" class="menu-title">????????????
          ??????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown">
          <a href="{{ route('admin.sellsint.index') }}" class="menu-item">
            ???????????? ?????????? ????????????????
          </a>
        </li>
        <li class="is-shown"><a href="{{ route('sells.index') }}" class="menu-item">???????????? ???????????? ????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('sells.create') }}" class="menu-item">?????????? ???????????? ?????? ????????</a>
        </li>
      </ul>
    </li>







    @can('pages.create', $userAuth)
   <!-- <li class=" nav-item"><a href="{{ route('purchases.index') }}"><span class="icon"><i
            class="fa fa-cart-arrow-down"></i></span><span data-i18n="nav.socials.main" class="menu-title"> ????????????
          ????????????</span></a>
    </li>-->
        <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-shopping-cart"></i></span><span
          data-i18n="nav.slider.main" class="menu-title">?????????????? ??????????
          </span></a>
      <ul class="menu-content" style="">
        <li class="is-shown">
            <a href="{{ route('purchases-prices-offers.create') }}?type=0" class="menu-item">
                ?????????? ?????? ?????? ????????
            </a>
        </li>
        <li class="is-shown">
            <a href="{{ route('purchases-prices-offers.index') }}?type=0" class="menu-item">
                ???????? ??????????????
            </a>
        </li>
        <li class="is-shown">
            <a href="{{ route('admin.purchases-orders.index') }}?type=0" class="menu-item">
                ?????????? ????????????
            </a>
        </li>
        <li class="is-shown"><a href="{{ route('purchases.index') }}?type=0" class="menu-item">???????????? ????????????
          </a>
        </li>
       <li class="is-shown"><a href="{{ route('purchases.create') }}?type=0" class="menu-item">?????????? ???????????? ????????????
          </a>
        </li>
      </ul>
    </li>
@if(Auth::user()->id == 9 || Auth::user()->id == 1)
  <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-shopping-cart"></i></span><span
          data-i18n="nav.slider.main" class="menu-title">?????????????? ??????????
          </span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('purchases-prices-offers.create') }}?type=1" class="menu-item">
            ?????????? ?????? ?????? ????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('purchases-prices-offers.index') }}?type=1" class="menu-item">????????
            ??????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('admin.purchases-orders.index') }}?type=1" class="menu-item">??????????
            ????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('purchases.index') }}?type=1" class="menu-item">???????????? ????????????
          </a>
        </li>
               <li class="is-shown"><a href="{{ route('purchases.create') }}?type=1" class="menu-item">?????????? ???????????? ????????????
          </a>
        </li>
      </ul>
    </li>
    @endif
    @endcan




    {{-- @if($userAuth->can('page-categories.create'))
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i
          class="fa fa-newspaper-o"></i></span><span data-i18n="nav.product.main" class="menu-title">????????????</span></a>
      <ul class="menu-content" style="">

        <li class="is-shown"><a href="{{ route('admin.stockreport') }}" class="menu-item">???????? ????????????</a>
    </li>


    <li class="is-shown"><a href="{{ route('admin.sold_report.index') }}" class="menu-item">????????????</a>
    </li>


    <li class="is-shown"><a href="{{ route('admin.buy_report.index') }}" class="menu-item">??????????????</a>
    </li>

    <!--   <li class="is-shown"><a href="{{ route('admin.mahgoz.index') }}" class="menu-item">???????????????? ????????????????</a>
        </li>


        <li class="is-shown"><a href="{{ route('admin.available.index') }}" class="menu-item">???????????????? ????????????????</a>
        </li>  -->


    </ul>
    </li>
    @endif --}}

    {{--  @can('settings.update', $userAuth)
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i
          class="fa fa-list"></i></span><span data-i18n="nav.menu.main" class="menu-title">??????????</span></a>
      <ul class="menu-content" style="">
        @if($userAuth->can('product-categories.create'))
        <li class="is-shown"><a href="{{ route('product-categories.index') }}" class="menu-item">?????? ??????????????????</a>
    </li>
    @endif

    @if($userAuth->can('users.create'))
    <li class="is-shown"><a href="{{ route('brands.index') }}" class="menu-item">?????? ????????????????</a>
    </li>
    @endif

    <li class="is-shown">
      <a href="{{ route('country.index') }}" class="menu-item">
        ?????? ??????????
      </a>
    </li>
    <li class="is-shown">
      <a href="{{ route('gifts.index') }}" class="menu-item">
        ?????? ??????????????
      </a>
    </li>
    <li class="is-shown">
      <a href="{{ route('color.index') }}" class="menu-item">
        ?????? ??????????????
      </a>
    </li>
    </ul>
    </li>


    @endcan --}}
    @can('settings.update', $userAuth)
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-map"></i></span><span
          data-i18n="nav.menu.main" class="menu-title">??????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown">
          <a href="{{ route('sanadat.index') }}?type=2" class="menu-item">
            ?????????? ??????
          </a>
        </li>
        <li class="is-shown" style="">
          <a href="{{ route('sanadat.index') }}?type=1" class="menu-item">
           ?????????? ??????
          </a>
        </li>
      </ul>
    </li>


    @endcan

    @if($userAuth->can('contacts.create'))
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-envelope"></i></span><span
          data-i18n="nav.slider.main" class="menu-title">??????????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('admin.sent.index') }}" class="menu-item">?????????????? ??????????????</a>
        </li>

        <li class="is-shown"><a href="{{ route('admin.incomes.index') }}" class="menu-item">?????????????? ??????????????</a>
        </li>
        <li class="is-shown"><a href="{{ route('admin.msg.index') }}" class="menu-item">?????????? ??????????</a>
        </li>
      </ul>
    </li>
    @endif


    @if($userAuth->can('roles.create'))
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-gavel"></i></span><span
          data-i18n="nav.roles.main" class="menu-title">{{ trans('admin.roles') }}</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('role.index') }}"
            class="menu-item">{{ trans('admin.show', ['name' => trans('admin.roles')]) }}</a>
        </li>
        <li class="is-shown"><a href="{{ route('role.create') }}"
            class="menu-item">{{ trans('admin.create', ['name' => trans('admin.role')]) }}</a>
        </li>
      </ul>
    </li>
    @endif


    @if($userAuth->can('users.create') || $userAuth->can('socials.update'))
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-group"></i></span><span
          data-i18n="nav.users.main" class="menu-title">?????????????? ????????????????</span></a>
      <ul class="menu-content" style="">
        @if($userAuth->can('users.create'))
        <li class="is-shown"><a href="{{ route('users.index') }}"
            class="menu-item">{{ trans('admin.show', ['name' => trans('admin.users')]) }}</a>
        </li>

        <li class="is-shown"><a href="{{ route('users.create') }}"
            class="menu-item">{{ trans('admin.create', ['name' => trans('admin.user')]) }}</a>
        </li>
                <li class="is-shown"><a href="{{ route('customercategory.index') }}" class="menu-item">?????????? ??????????????</a>
        </li>
        @endif
        @if($userAuth->can('socials.update'))
        <li class="is-shown"><a href="{{ route('customers.index') }}" class="menu-item">?????? ??????????????</a>
        </li>


        <li class="is-shown"><a href="{{ route('customers.create') }}" class="menu-item">?????????? ????????</a>
        </li>
        @endif
      </ul>
    </li>
    @endif
    @if($userAuth->can('roles.create'))
    <li class="nav-item has-sub"><a href="#"><span class="icon"><i class="fa fa-user"></i></span><span
          data-i18n="nav.roles.main" class="menu-title">????????????????</span></a>
      <ul class="menu-content" style="">
        <li class="is-shown"><a href="{{ route('supplier.index') }}"
            class="menu-item">{{ trans('admin.show', ['name' => '????????????????']) }}</a>
        </li>
        <li class="is-shown"><a href="{{ route('supplier.create') }}"
            class="menu-item">{{ trans('admin.create', ['name' => '????????']) }}</a>
        </li>
      </ul>
    </li>
    @endif


    </ul>
  </div>
  <!-- /main menu content-->
  <!-- main menu footer-->
  <!-- include includes/menu-footer-->
  <!-- main menu footer-->
</div>
<!-- / main menu-->

<style>
  a.navbar-brand.nav-link {
    margin-left: 30px;
  }
</style>
