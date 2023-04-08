@extends('admin._layouts.index')
@section('title','Trang chu quan tri')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="row">
            <div class="col-xl-8">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Trang tổng quan
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                           
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class=" ml-4">
                                    @if( 5 < $hours && $hours <= 12)
                                        <h2 style="font-weight:600">Chào buổi sáng, <span style="color:#3699ff">{{ Auth::user()->name }}</span></h2>
                                    @elseif( 12 < $hours && $hours <= 18)
                                        <h2 style="font-weight:600">Chào buổi chiều, <span style="color:#3699ff">{{ Auth::user()->name }}</span></h2>
                                    @elseif( 18 < $hours && $hours <= 23)
                                        <h2 style="font-weight:600">Chào buổi tối, <span style="color:#3699ff">{{ Auth::user()->name }}</span></h2>
                                    @else
                                        <h2 style="font-weight:600">Chúc ngủ ngon, <span style="color:#3699ff">{{ Auth::user()->name }}</span></h2>
                                    @endif
                                    <h6 class="mt-3" style="font-weight: 600">Noel sắp đến rồi, Chúng ta hãy cố gắng nhé :3</h6>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <img class="img-fluid" src="https://www.upsieutoc.com/images/2020/11/12/xmas_2020.gif" alt="">
                            </div>
                        </div>
                        <div class="">
							<div class="row">
								<div class="col-xl-6">
                                    <div class="m-widget1">
                                        <div class="m-widget1__item">
                                            <div class="row m-row--no-padding align-items-center">
                                                <div class="col">
                                                    <h3 class="m-widget1__title">Đơn hàng trong tháng</h3>
                                                    {{-- <span class="m-widget1__desc">Năm 2020</span> --}}
                                                </div>
                                                <div class="col m--align-right">
                                                    <span class="m-widget1__number m--font-brand">{{$count_order_month}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-widget1__item">
                                            <div class="row m-row--no-padding align-items-center">
                                                <div class="col">
                                                    <h3 class="m-widget1__title">Đã xử lí</h3>
                                                    {{-- <span class="m-widget1__desc">Weekly Customer Orders</span> --}}
                                                </div>
                                                <div class="col m--align-right">
                                                    <span class="m-widget1__number m--font-danger"> {{$count_status_order_month}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-widget1__item">
                                            <div class="row m-row--no-padding align-items-center">
                                                <div class="col">
                                                    <h3 class="m-widget1__title">Chưa xử lí</h3>
                                                    {{-- <span class="m-widget1__desc">System bugs and issues</span> --}}
                                                </div>
                                                <div class="col m--align-right">
                                                <span class="m-widget1__number m--font-success">{{$none_count_order_month}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="m-widget14">
                                        <div class="row  align-items-center">
                                            <div class="col">
                                                <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                                    <div class="m-widget14__stat">{{$count_order_month}}</div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="m-widget14__legends">
                                                    <div class="m-widget14__legend">
                                                        <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                                        <span class="m-widget14__legend-text">37% Sport Tickets</span>
                                                    </div>
                                                    <div class="m-widget14__legend">
                                                        <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                                        <span class="m-widget14__legend-text">47% Business Events</span>
                                                    </div>
                                                    <div class="m-widget14__legend">
                                                        <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                                        <span class="m-widget14__legend-text">19% Others</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Audit Log-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thông báo sự kiện
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-scrollable" data-scrollable="true" data-height="350" data-mobile-height="300">
                            <!--Begin::Timeline 2 -->
                            <div class="m-timeline-2">
                                <div class="m-timeline-2__items  m--padding-top-25 m--padding-bottom-30">
                                    <div class="m-timeline-2__item">
                                        <span class="m-timeline-2__item-time">10:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-danger"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text  m--padding-top-5">
                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                            incididunt ut labore et dolore magna
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">12:45</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-success"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m-timeline-2__item-text--bold">
                                            AEOL Meeting With
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">14:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-brand"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m--padding-top-5">
                                            Make Deposit <a href="#" class="m-link m-link--brand m--font-bolder">USD 700</a> To ESL.
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">16:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-warning"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m--padding-top-5">
                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                            incididunt ut labore et dolore magna elit enim at minim<br>
                                            veniam quis nostrud
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">17:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-info"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m--padding-top-5">
                                            Placed a new order in <a href="#" class="m-link m-link--brand m--font-bolder">SIGNATURE MOBILE</a> marketplace.
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">16:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-brand"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m--padding-top-5">
                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                            incididunt ut labore et dolore magna elit enim at minim<br>
                                            veniam quis nostrud
                                        </div>
                                    </div>
                                    <div class="m-timeline-2__item m--margin-top-30">
                                        <span class="m-timeline-2__item-time">17:00</span>
                                        <div class="m-timeline-2__item-cricle">
                                            <i class="fa fa-genderless m--font-danger"></i>
                                        </div>
                                        <div class="m-timeline-2__item-text m--padding-top-5">
                                            Received a new feedback on <a href="#" class="m-link m-link--brand m--font-bolder">FinancePro App</a> product.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--End::Timeline 2 -->
                        </div>
                    </div>
                    
                </div>

                <!--end:: Widgets/Audit Log-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">

                <!--begin:: Widgets/Activity-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                   Doanh thu
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget17">
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                                <div class="m-widget17__chart" style="height:320px;">
                                    <canvas id="m_chart_activities"></canvas>
                                </div>
                            </div>
                            <div class="m-widget17__stats">
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-truck m--font-brand"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Ngày hôm nay
														</span>
                                        <span class="m-widget17__desc">
                                                            {{$count1}} Đơn hàng
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-paper-plane m--font-info"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Doanh thu ngày
														</span>
                                        <span class="m-widget17__desc">
                                                            {{number_format($sum1)}} VNĐ
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col2">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-pie-chart m--font-success"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Tháng này
														</span>
                                        <span class="m-widget17__desc">
                                                            {{$count}} Đơn hàng
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-time m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Doanh thu tháng
														</span>
                                        <span class="m-widget17__desc">
                                                            {{number_format($sum)}} VNĐ
														</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Activity-->
            </div>
            <div class="col-xl-6">

                <!--begin:: Widgets/Support Tickets -->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Phản hồi từ khách hàng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-scrollable m-widget3" data-scrollable="true" data-height="500" data-mobile-height="300">
                            @foreach ($feekback as $item)
                            <div class="m-widget3__item">
                                <div class="m-widget3__header">
                                    <div class="m-widget3__user-img">
                                        <img class="m-widget3__img" src="https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png" alt="">
                                    </div>
                                    <div class="m-widget3__info">
                                        <span class="m-widget3__username">
                                            {{$item->name}}
                                        </span><br>
                                        <span class="m-widget3__time">
                                            {{date('d-m-Y', strtotime($item->updated_at))}}
                                        </span>
                                    </div>
                                </div>
                                <div class="m-widget3__body">
                                    <p class="m-widget3__text">
                                        {{$item->content}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Support Tickets -->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Hoạt động
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
                                        Sản phẩm
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab">
                                        Bài viết
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_widget2_tab1_content">

                                <!--Begin::Timeline 3 -->
                                <div class="m-timeline-3">
                                    <div class="m-scrollable m-timeline-3__items" data-scrollable="true" data-height="500" data-mobile-height="300">
                                        @foreach($product as $key => $item)
                                        <div class="m-timeline-3__item m-timeline-3__item--info">
                                            <span class="m-timeline-3__item-time">{{date('H:i', strtotime($item->updated_at))}}</span>
                                            <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	{{$item->author}} đã thêm một sản phẩm
																</span><br>
                                                <span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		{{$item->title}}
																	</a>
																</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!--End::Timeline 3 -->
                            </div>
                            <div class="tab-pane" id="m_widget2_tab2_content">

                                <!--Begin::Timeline 3 -->
                                <div class="m-timeline-3">
                                    <div class="m-scrollable m-timeline-3__items" data-scrollable="true" data-height="500" data-mobile-height="300">
                                        @foreach($news as $item)
                                        <div class="m-timeline-3__item m-timeline-3__item--danger">
                                            <span class="m-timeline-3__item-time m--font-warning">{{date('H:i', strtotime($item->updated_at))}}</span>
                                            <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	{{$item->author}} đã thêm một bài viết
																</span><br>
                                                <span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		{{$item->title}}
																	</a>
																</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!--End::Timeline 3 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-action">
                                <button style="font-family: 'Roboto', sans-serif" type="button" class="btn btn-sm m-btn--pill  btn-brand">Bài đăng mới nhất</button>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                                <img src="{{\App\Library\Files::media( $new->image )}}" alt="">
                                <h3 class="m-widget19__title m--font-light">
                                    {{ $new->title }}
                                </h3>
                                <div class="m-widget19__shadow"></div>
                            </div>
                            <div class="m-widget19__content">
                                <div class="m-widget19__header">
                                    <div class="m-widget19__user-img">
                                        @if(Auth::user()->image)
                                            <img class="m-widget19__img" src="{{\App\Library\Files::media( Auth::user()->image )}}" class="m--img-rounded m--marginless" alt="" />
                                        @else
                                            <img src="/assets/backend/images/image-user.jpg" class="m--img-rounded m--marginless" alt="" />
                                        @endif
                                    </div>
                                    <div class="m-widget19__info">
														<span class="m-widget19__username">
															{{$new->author}}
														</span><br>
                                        <span class="m-widget19__time">
                                                    {{date('H:i', strtotime($new->updated_at))}}
														</span>
                                    </div>
                                    <div class="m-widget19__stats">
														<span class="m-widget19__number m--font-brand">
															{{date('d', strtotime($new->updated_at))}}
														</span>
                                        <span style="margin-left: -20px" class="m-widget19__comment">
                                                            Tháng <p style="margin-left: 50px">{{date('m', strtotime($new->updated_at))}}</p>
														</span>
                                    </div>
                                </div>
                                <div class="m-widget19__body">
                                   {!! $new->description !!}
                                </div>
                            </div>
                            <div class="m-widget19__action">
                                <a target="_blank" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="{{url('blog/bai-viet/'.$new->slug)}}">Xem bài viết</a>
                                {{-- <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Xem bài viết</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
</div>

@stop