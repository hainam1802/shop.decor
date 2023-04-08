<?php

function getCategories($mang,$parentId,$char,$isParent){
    foreach ($mang as $key => $value) {
        if($value['parrent_id'] == $parentId){
            if($value['id'] == $isParent){
                echo '<option selected value="'. $value['id'] .'">'.$char.$value['title'].'</option>';
            }else{
                echo '<option value="'. $value['id'] .'">'.$char.$value['title'].'</option>';
            }
            $new_parent = $value['id'];
            getCategories($mang,$new_parent,$char."--| ", $isParent );
        }

    }
}


function getPermission($mang,$parentId,$char,$isParent){
    foreach ($mang as $key => $value) {
        if($value['parrent_id'] == $parentId){
            if($value['id'] == $isParent){
                echo '<option selected value="'. $value['id'] .'">'.$char.$value['title'].'</option>';
            }else{
                echo '<option value="'. $value['id'] .'">'.$char.$value['title'].'</option>';
            }
            $new_parent = $value['id'];
            getCategories($mang,$new_parent,$char."--| ", $isParent );
        }

    }
}



function listCategory($mang, $parentId, $char){
//    print_r("<pre>");
//    print_r($parentId);
//    die();
    foreach ($mang as $key => $value) {
        if($value['parrent_id'] == $parentId){
        $string = '';
        $string .=  '<div class="item-menu"><span>';
        $string .= $char.$value['module'];
        $string .= '</span>';
        $string .= '<div class="category-fix" style="margin-top: -9px">';
        $string .= '<a class="btn btn-primary" href="'.route('category.edit',[$value['id']]).'"><i class="fa fa-edit"></i></a>';
        $string .= '<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="'.route('category.destroy',[$value['id']]).'"><i class="fas fa-trash-alt"></i></button>';
        $string .="</div>";
        $string .="</div>";
        echo  $string;
            listCategory($mang,$value['id'],$char."--| " );
        }

    }
}
function menuCategory($mang, $parentId,$char = ''){
    foreach ($mang as $key => $value) {
        if($value['parent_id'] == $parentId){
            $string = '<li class="m-menu__item " aria-haspopup="true"><a href="" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">';
            $string = $value['name'];
            $string = '</span></a></li>';
            echo  $string;
            menuCategory($mang,$value['id']);
        }
    }
}


?>
