@php
$Title = isset($pageTitle) ? $pageTitle : trans('admin.home');
$pageTitle = $Title;
@endphp
<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
  <!-- main menu header-->
  {{-- <div class="main-menu-header">
    <!--<input type="text" placeholder="{{ trans('admin.search') }}" class="menu-search form-control round"/>-->
    {{-- <h5>{{ $userAuth->email }}</h5>
  </div> --}}
  <!-- / main menu header-->
  <!-- main menu content-->
  <div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <li style="margin-top: 12px;" class=" nav-item {{ getActiveByVar($pageTitle, trans('admin.home')) }}"><a href="{{ route('admin.home') }}"><i
            class="icon-home3"></i><span data-i18n="nav.dash.main"
            class="menu-title">{{ trans('admin.home') }}</span></a>
      </li>


      @if($userAuth->can('sliders.view') || $userAuth->can('sliders.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle,'visits', 'open') }}"><a href="#"><i
            class="fa fa-map"></i><span data-i18n="nav.menu.main"
            class="menu-title">الزيارات</span></a>
        <ul class="menu-content" style="">
                      @if($userAuth->can('sliders.view'))
          <li class="is-shown">
            <a href="{{ route('visits.index') }}" class="menu-item">
              عرض الزيارات
            </a>
          </li>
          @endif
          @if($userAuth->can('sliders.create'))
          <li class="is-shown" style="">
            <a href="{{ route('visits.create') }}" class="menu-item">
              اضافه زياره جديده
            </a>
          </li>
           @endif

        @if($userAuth->can('sliders.show'))
          <li class="is-shown" style="">
            <a href="{{ route('admin.sendpriceoffer') }}" class="menu-item">
              تقديم عرض سعر
            </a>
          </li>
          @endif
        </ul>
      </li>
      @endif

         @if($userAuth->can('pages.create') || $userAuth->can('pages.edit'))
      <li class=" nav-item {{ getActiveByVar($pageTitle, 'preparing_orders') }}"><a
          href="{{ route('admin.preparing_orders.index') }}"><i class="fa fa-tasks"></i><span data-i18n="nav.socials.main"
            class="menu-title">عرض اوامر التحضير </span></a>
      </li>
      @endif


     @if($userAuth->can('pages.show') || $userAuth->can('pages.delete'))
      <li class=" nav-item {{ getActiveByVar($pageTitle, 'delivery_orders') }}"><a
          href="{{ route('admin.delivery_orders.index') }}"><i class="fa fa-truck"></i><span data-i18n="nav.socials.main"
            class="menu-title">عرض اوامر التسليم</span></a>
      </li>
      @endif

    @can('contacts.view', $userAuth)
      <li class=" nav-item {{ getActiveByVar($pageTitle, 'caroc-report') }}"><a
          href="{{ route('admin.caroc-report.index') }}"><i class="fa fa-file"></i><span data-i18n="nav.socials.main"
            class="menu-title">نموزج كروكيه </span></a>
      </li>
      @endcan




      @if($userAuth->can('products.view') || $userAuth->can('products.create') ||
      $userAuth->can('product-categories.view') || $userAuth->can('product-categories.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.products'), 'open') }}"><a href="#"><i
            class="fa fa-product-hunt"></i><span data-i18n="nav.product.main"
            class="menu-title">المنتجات</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('product-categories.view'))
          <li class="is-shown"><a href="{{ route('product-categories.index') }}"
              class="menu-item">عرض اقسام المنتجات</a>
          </li>
          @endif

          @if($userAuth->can('product-categories.create'))
          <li class="is-shown"><a href="{{ route('product-categories.create') }}"
              class="menu-item">اضافه قسم جديد</a>
          </li>
          @endif

          @if($userAuth->can('products.view'))
          <li class="is-shown"><a href="{{ route('product.index') }}"
              class="menu-item">عرض المنتجات</a>
          </li>
          @endif

          @if($userAuth->can('products.create'))
          <li class="is-shown"><a href="{{ route('product.create') }}"
              class="menu-item">اضافه منتج جديد</a>
          </li>
          @endif

          @if($userAuth->can('products.create'))
          <li class="is-shown"><a href="{{ route('purchases.product.get') }}"
              class="menu-item">شراء منتج</a>
          </li>
          @endif

        </ul>
      </li>
      @endif
      @if($userAuth->can('page-categories.create') || $userAuth->can('page-categories.edit') ||
      $userAuth->can('page-categories.show') || $userAuth->can('page-categories.delete'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle,'movment-track', 'open') }}"><a href="#"><i
            class="fa fa-newspaper-o"></i><span data-i18n="nav.product.main"
            class="menu-title">ملخص الحركه</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('page-categories.create'))
          <li class="is-shown"><a href="{{ route('admin.sold_report.index') }}"
              class="menu-item">تم بيعه</a>
          </li>
          @endif

          @if($userAuth->can('page-categories.edit'))
          <li class="is-shown"><a href="{{ route('admin.buy_report.index') }}"
              class="menu-item">تم شراءه</a>
          </li>
          @endif

          @if($userAuth->can('page-categories.show'))
          <li class="is-shown"><a href="{{ route('admin.mahgoz.index') }}"
              class="menu-item">المنتجات المحجوزه</a>
          </li>
          @endif

          @if($userAuth->can('page-categories.delete'))
          <li class="is-shown"><a href="{{ route('admin.available.index') }}"
              class="menu-item">المنتجات المتوفره</a>
          </li>
          @endif

        </ul>
      </li>
      @endif



      {{-- @can('settings.update', $userAuth)

      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.settings'), 'open') }}"><a href="#"><i
            class="icon-cogs2"></i><span data-i18n="nav.menu.main"
            class="menu-title">{{ trans('admin.settings') }}</span></a>
        <ul class="menu-content" style="">

          <li class="is-shown">
            <a href="{{ route('admin.settings') }}" class="menu-item">
              {{ trans('admin.settings') }}
            </a>
          </li>

          <li class="is-shown" style="">
            <a href="{{ route('admin.settings.layouts') }}" class="menu-item">
              {{ trans('admin.layouts') }}
            </a>
          </li>

        </ul>
      </li>

      @endcan --}}

      {{-- @can('socials.update', $userAuth)
      <li class=" nav-item {{ getActiveByVar($pageTitle, trans('admin.socials')) }}"><a
          href="{{ route('admin.social') }}"><i class="fa fa-twitter"></i><span data-i18n="nav.socials.main"
            class="menu-title">{{ trans('admin.socials') }}</span></a>
      </li>
      @endcan --}}

      {{-- @can('layouts.update', $userAuth)
      <li class=" nav-item {{ getActiveByVar($pageTitle, trans('admin.layouts')) }}"><a
          href="{{ route('layout.index') }}"><i class="fa fa-paragraph"></i><span data-i18n="nav.layouts.main"
            class="menu-title">{{ trans('admin.layouts') }}</span></a>
      </li>
      @endcan --}}



      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, 'messages', 'open') }}"><a href="#"><i
            class="fa fa-envelope"></i><span data-i18n="nav.slider.main"
            class="menu-title">الرسائل</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a href="{{ route('admin.sent.index') }}"
              class="menu-item">الرسائل الصادره</a>
          </li>
          <li class="is-shown"><a href="{{ route('admin.incomes.index') }}"
            class="menu-item">الرسائل الوارده</a>
        </li>
          <li class="is-shown"><a href="{{ route('admin.msg.index') }}"
            class="menu-item">ارسال رساله</a>
        </li>
        </ul>
      </li>



{{--
      <li class="nav-item {{ getActiveByVar($pageTitle, trans('admin.contacts')) }}"><a
          href="{{ route('contact.index') }}"><i class="fa fa-envelope"></i><span data-i18n="nav.layouts.main"
            class="menu-title"> {{ trans('admin.show', ['name' => trans('admin.contacts')])}} </span></a>
      </li>
      @if($userAuth->can('sliders.view') || $userAuth->can('sliders.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.sliders'), 'open') }}"><a href="#"><i
            class="fa fa-image"></i><span data-i18n="nav.slider.main"
            class="menu-title">{{ trans('admin.sliders') }}</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('sliders.view'))
          <li class="is-shown"><a href="{{ route('slider.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.sliders')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('sliders.create'))
          <li class="is-shown"><a href="{{ route('slider.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.slider')]) }}</a>
          </li>
          @endif
        </ul>
      </li>
      @endif --}}

      {{-- @if($userAuth->can('pages.view') || $userAuth->can('pages.create') || $userAuth->can('page-categories.view') ||
      $userAuth->can('page-categories.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.pages'), 'open') }}"><a href="#"><i
            class="fa fa-file"></i><span data-i18n="nav.page.main"
            class="menu-title">{{ trans('admin.pages') }}</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('page-categories.view'))
          <li class="is-shown"><a href="{{ route('page-categories.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.page-categories')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('page-categories.create'))
          <li class="is-shown"><a href="{{ route('page-categories.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.page-categories')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('pages.view'))
          <li class="is-shown"><a href="{{ route('page.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.pages')])}}</a>
          </li>
          @endif

          @if($userAuth->can('pages.create'))
          <li class="is-shown"><a href="{{ route('page.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.page')]) }}</a>
          </li>
          @endif

        </ul>
      </li>
      @endif --}}














{{--
      @if($userAuth->can('menus.view') || $userAuth->can('menus.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.menus'), 'open') }}"><a href="#"><i
            class="fa fa-bars"></i><span data-i18n="nav.menu.main"
            class="menu-title">{{ trans('admin.menus') }}</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('menus.view'))
          <li class="is-shown"><a href="{{ route('menu.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.menus')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('menus.create'))
          <li class="is-shown"><a href="{{ route('menu.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.menu')]) }}</a>
          </li>
          @endif
        </ul>
      </li>
      @endif --}}

      {{-- @if($userAuth->can('footers.view') || $userAuth->can('footers.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.footers'), 'open') }}"><a href="#"><i
            class="fa fa-link"></i><span data-i18n="nav.footer.main"
            class="menu-title">{{ trans('admin.footers') }}</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('footers.view'))
          <li class="is-shown"><a href="{{ route('footer.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.footers')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('footers.create'))
          <li class="is-shown"><a href="{{ route('footer.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.footer')]) }}</a>
          </li>
          @endif
        </ul>
      </li>
      @endif --}}





      @if($userAuth->can('roles.view') || $userAuth->can('roles.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.roles'), 'open') }}"><a href="#"><i
            class="fa fa-gavel"></i><span data-i18n="nav.roles.main"
            class="menu-title">{{ trans('admin.roles') }}</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('roles.view'))
          <li class="is-shown"><a href="{{ route('role.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.roles')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('roles.create'))
          <li class="is-shown"><a href="{{ route('role.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.role')]) }}</a>
          </li>
          @endif
        </ul>
      </li>
      @endif


      @if($userAuth->can('users.view') || $userAuth->can('users.create')||$userAuth->can('menus.view') || $userAuth->can('menus.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.users'), 'open') }}"><a href="#"><i
            class="fa fa-group"></i><span data-i18n="nav.users.main"
            class="menu-title">الاعضاء والزبائن</span></a>
        <ul class="menu-content" style="">
          @if($userAuth->can('users.view'))
          <li class="is-shown"><a href="{{ route('users.index') }}"
              class="menu-item">{{ trans('admin.show', ['name' => trans('admin.users')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('users.create'))
          <li class="is-shown"><a href="{{ route('users.create') }}"
              class="menu-item">{{ trans('admin.create', ['name' => trans('admin.user')]) }}</a>
          </li>
          @endif

          @if($userAuth->can('menus.view'))
          <li class="is-shown"><a href="{{ route('customers.index') }}"
              class="menu-item">عرض الزبائن</a>
          </li>
          @endif

          @if($userAuth->can('menus.create'))
          <li class="is-shown"><a href="{{ route('customers.create') }}"
              class="menu-item">انشاء زبون</a>
          </li>
          @endif
        </ul>
      </li>
      @endif

      {{-- @if($userAuth->can('users.view') || $userAuth->can('users.create'))
      <li class="nav-item has-sub {{ getActiveByVar($pageTitle, trans('admin.seo'), 'open') }}"><a href="#"><i
            class="fa fa-search"></i><span data-i18n="nav.users.main"
            class="menu-title">{{ trans('admin.seo') }}</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a href="{{ route('admin.seo.tags.form') }}"
              class="menu-item">{{ trans('admin.get_meta') }}</a>
          </li>
          <li class="is-shown"><a href="{{ route('admin.seo.sitemap.form') }}"
              class="menu-item">{{ trans('admin.sitemap') }}</a>
          </li>
        </ul>
      </li>
      @endif --}}

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
