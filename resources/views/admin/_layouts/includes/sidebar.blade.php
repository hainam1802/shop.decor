<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/admin/dashboard')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">{{__('Trang chủ quản trị')}}</span>
											<span class="m-menu__link-badge"><span class="m-badge m-badge--danger">2</span></span> </span></span></a></li>
        <li class="m-menu__section ">
        <h4 class="m-menu__section-text">{{__('Hệ thống') }}</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('user.index')}} " class="m-menu__link "><i class="m-menu__link-icon fa fa-user"><span></span></i><span class="m-menu__link-text">{{__('Quản lí thành viên')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('permission.index')}} " class="m-menu__link "><i class="m-menu__link-icon la la-sitemap"><span></span></i><span class="m-menu__link-text">{{__('Quyền người dùng')}}</span></a></li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-language"></i><span class="m-menu__link-text">{{__('Ngôn ngữ')}}</span><i
            class="m-menu__ver-arrow la la-angle-right"></i></a>
        <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('language-key.index')}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Từ khóa')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('language-nation.index')}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Ngôn ngữ hệ thống')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('language-mapping.index')}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Biên dịch')}}</span></a></li>
        </ul>
    </div>
</li>

        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">{{__('Nội dung') }}</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        @foreach($module_item as $module)
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon @if(isset($module->icon)) {{$module->icon}} @else flaticon-list-3 @endif"></i><span class="m-menu__link-text">{{__($module->title)}}</span><i
            class="m-menu__ver-arrow la la-angle-right"></i></a>
        <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item " aria-haspopup="true"><a href=" {{url('admin/module-category/'.$module->slug)}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Danh mục')}}</span></a></li>
                <li class="m-menu__item " aria-haspopup="true"><a href=" {{url('admin/module-item/'.$module->slug)}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__($module->title)}}</span></a></li>
            </ul>
        </div>
        @endforeach
        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">{{__('Khách hàng') }}</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fas fa-shopping-cart"></i><span class="m-menu__link-text">{{__('Quản lí đơn hàng')}}</span><i
            class="m-menu__ver-arrow la la-angle-right"></i></a>
        <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('order.index')}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Chưa xử lí')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('order-done.index')}} " class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{__('Đã xử lí')}}</span></a></li>
        </ul>
    </div>
</li>
        <li class="m-menu__item " aria-haspopup="true"><a href="{{route('feedback.index')}}" class="m-menu__link "><i class="m-menu__link-icon fas fa-comment-dots"><span></span></i><span class="m-menu__link-text">{{__('Phản hồi')}}</span></a></li>
        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">{{__('Cấu hình') }}</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('setting-module.index')}} " class="m-menu__link "><i class="m-menu__link-icon fas fa-sliders-h"><span></span></i><span class="m-menu__link-text">{{__('Module hệ thống')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('advertisement.index')}} " class="m-menu__link "><i class="m-menu__link-icon flaticon-imac"><span></span></i><span class="m-menu__link-text">{{__('Cấu hình quảng cáo')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('clear-cache')}} " class="m-menu__link "><i class="m-menu__link-icon fas fa-user-cog"><span></span></i><span class="m-menu__link-text">{{__('Xóa Cache')}}</span></a></li>
        <li class="m-menu__item " aria-haspopup="true"><a href=" {{route('setting.index')}} " class="m-menu__link "><i class="m-menu__link-icon fas fa-cogs"><span></span></i><span class="m-menu__link-text">{{__('Cài đặt')}}</span></a></li>
    </ul>
</div>