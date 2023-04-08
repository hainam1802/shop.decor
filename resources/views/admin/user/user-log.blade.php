@extends('admin._layouts.index')
@section('title',' Lịch sử hoạt động')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Nhật kí hoạt động')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text"> {{__('Lịch sử hoạt động của tôi')}} </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-subheader">
            <div class="m-portlet">
            <div class="m-portlet m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									 {{__('Lịch sử hoạt động')}} 
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
										{{__('Hôm nay')}}
									</a>
								</li>
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab">
										{{__('Tháng này')}}
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="m_widget2_tab1_content">

												<!--Begin::Timeline 3 -->
								<div class="m-timeline-3 m-scrollable m-scroller" data-scrollable="true" style="height:550px;overflow: hidden;">
									<div class="m-timeline-3__items">
										@foreach($day_log as $item)
										<div class="m-timeline-3__item m-timeline-3__item--info">
											<span class="m-timeline-3__item-time">{{date('H:i', strtotime($item->created_at))}}</span>
											<div class="m-timeline-3__item-desc">
												<span class="m-timeline-3__item-text">
													{{$item->description}}
												</span><br>
												<span class="m-timeline-3__item-user-name">
													<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
														{{__('Từ')}}: {{$item->user_agent}}
													</a>
												</span>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
								<div class="tab-pane" id="m_widget2_tab2_content">
									<div class="m-timeline-3" data-scrollable="true" style="height:550px;overflow: hidden;">
										<div class="m-timeline-3__items">
										@foreach($month_log as $item)
										<div class="m-timeline-3__item m-timeline-3__item--info">
											<span class="m-timeline-3__item-time">{{date('H:i', strtotime($item->created_at))}}</span>
											<div class="m-timeline-3__item-desc">
												<span class="m-timeline-3__item-text">
													{{$item->description}}
												</span><br>
												<span class="m-timeline-3__item-user-name">
													<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
														{{__('Từ')}}: {{$item->user_agent}}
													</a>
													<br>
													<p class="m-link m-link--metal m-timeline-3__item-link">
														{{date('d-m-yy', strtotime($item->created_at))}}
													</p>
												</span>
											</div>
										</div>
										@endforeach			
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
            </div>
        </div>
	</div>
@stop
