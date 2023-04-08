@extends('admin._layouts.index')
@section('title','Phân quyền')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 style="font-family: Arial, Helvetica, sans-serif" class="m-subheader__title m-subheader__title--separator"> {{__('Phân quyền')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('user.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text"> {{__('Danh sách thành viên')}} </span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text"> {{__('Trao quyền')}} </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-subheader mb-4">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('Thành viên')}} : {{$data->name}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-section">
                <div class="m-portlet__body">
                    <div class="m-portlet__body">
                        <form action="{{route('user.post-permisson',$data->id)}}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <ul style="ul:list-style-type: none;" class="multi-checkbox-container__list list--parent list-unstyled checktree">
                            <li>
                                <input type="checkbox" value="" class="checkbox-container__input input--parent" id="unique-event-identifier-001">
                                <label class="checkbox-container__label"> {{__('Chọn tất cả')}} </label>
                            </li>
                            @if(isset($permission) && !empty($permission))
                                @foreach($permission as $pers)
                                    @if($pers->parrent_id == 0)
                                        <li class="multi-checkbox-container__list__item item--event">
                                                <p>{{__($pers->title)}}</p>
                                                    <ul class="multi-checkbox-container__list list--children">
                                                        @foreach($permission as $per)
                                                            @if($pers->id == $per->parrent_id)
                                                                <div class="form__inputs__checkbox-container">
                                                                <input name="permission[]" value="{{$per->name}}" type="checkbox" class="checkbox-container__input input--child" id="unique-video-identifier-001"
                                                                @foreach ($id_permisson as $idp)
                                                                    {{ $idp->name == $per->name ? 'checked' : "" }}
                                                                @endforeach
                                                                >
                                                                    <label class="checkbox-container__label" for="unique-video-identifier-001">{{__($per->title)}}</label>   
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                            <button type="submit" class="btn btn-primary"> {{__('Gán Quyền')}} </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END: Subheader -->
    </div>
    <script>
        $(function() {
        var eventVideoCheckbox = $('.checkbox-container__input');
    
        eventVideoCheckbox.change(function(){
            // Detect if this is a child checkbox, by checking if the closest parent has children class
            if ($(this).closest('.multi-checkbox-container__list').hasClass('list--children')) {
                // Defining the parent checkbox
                var parentCheckbox = $(this).closest('.list--parent').find('.input--parent'),
                    // Defining all siblings
                    siblings = $(this).closest('.list--children'),
                    // Defining all sibling checkboxes
                    siblingCheckboxes = siblings.find('.input--child'),
                    // Defining all checked sibling checkboxes
                    siblingCheckboxesChecked = siblings.find('.input--child:checked');
    
                if (siblingCheckboxesChecked.length == siblingCheckboxes.length) {
                    parentCheckbox.prop({
                        indeterminate: false,
                        checked: true
                    });
                } else if (siblingCheckboxes.is(':checked')) {
                    parentCheckbox.prop({
                        indeterminate: true,
                        checked: false
                    });
                } else {
                    parentCheckbox.prop({
                        indeterminate: false,
                        checked: false
                    });
                }
    
            // Else if parent checkbox...
            } else if ($(this).closest('.multi-checkbox-container__list').hasClass('list--parent')) {
                var childrenCheckboxes = $(this).closest('.list--parent').find('.input--child');
    
                if ($(this).is(':checked')) {
                    childrenCheckboxes.prop({
                        checked: true
                    });
                } else {
                    childrenCheckboxes.prop({
                        checked: false
                    });
                }
            }
        })
    });
    </script>
@stop
