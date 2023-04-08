<?php

return [

    'app' => [
        'title' => 'Hệ thống',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-settings',
        'class' => 'active show',

        'elements' => [
            [
                'label' => 'Tiêu đề trang', // you know what label it is
                'name' => 'app_title', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Mô tả', // you know what label it is
                'name' => 'app_description', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Từ khóa', // you know what label it is
                'name' => 'app_keyword', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Địa chỉ', // you know what label it is
                'name' => 'app_address', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Điện thoại', // you know what label it is
                'name' => 'app_phone', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Email liên hệ', // you know what label it is
                'name' => 'app_mail', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link fanpage Facebook', // you know what label it is
                'name' => 'app_fanpage', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Link Youtube', // you know what label it is
                'name' => 'app_youtube', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link Twitter', // you know what label it is
                'name' => 'app_twitter', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link fanpage G+', // you know what label it is
                'name' => 'app_google_plus', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],


            [
                'label' => 'Nội dung thông báo popup (Trang chủ)', // you know what label it is
                'name' => 'app_popup_homepage', // unique name for field
                'type' => 'ckeditor', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want

            ],

            [
                'label' => 'Nội dung footer', // you know what label it is
                'name' => 'app_footer', // unique name for field
                'type' => 'ckeditor_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want

            ],
        ]
    ],
    'email' => [
        'title' => 'Email',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-email',

        'elements' => [

            [
                'label' => 'Máy chủ', // you know what label it is
                'name' => 'app_email_host', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Port', // you know what label it is
                'name' => 'app_email_port', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Tài khoản', // you know what label it is
                'name' => 'app_email_username', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Mật khẩu', // you know what label it is
                'name' => 'app_email_password', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

        ]
    ],
    'code' => [
        'title' => 'Mã nhúng script',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-responsive',

        'elements' => [

            [
                'label' => 'Google Analytics', // you know what label it is
                'name' => 'app_code_ga', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Chatbox', // you know what label it is
                'name' => 'app_code_chatbox', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Google map', // you know what label it is
                'name' => 'app_code_ggmap', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Mã khác', // you know what label it is
                'name' => 'app_code_other', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

        ]
    ],

    'cache' => [
        'title' => 'Quản lý cache',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-more-v4',

        'elements' => [

            [
                'label' => 'Active cache', // you know what label it is
                'name' => 'app_cache_ative', // unique name for field
                'type' => 'checkbox', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Thời gian cache', // you know what label it is
                'name' => 'app_cache_time', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],


        ]
    ],

];





//demo element
//[
//                'label' => 'Điện thoại check đúng', // you know what label it is
//                'name' => 'checkboaaaa', // unique name for field
//                'type' => 'checkbox', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ],
//
//            [
//                'label' => 'Check thử', // you know what label it is
//                'name' => 'status', // unique name for field
//                'type' => 'select', // input fields type
//                'data' => 'int', // data type, string, int, boolean
//                'rules' => 'required|max:255', // validation rule of laravel
//                'class' => 'col-md-3', // any class for input
//                'value' => '', // default value if you want
//                'options' => [
//                    '1' => 'Yes',
//                    '0' => 'No'
//                ]
//            ],

