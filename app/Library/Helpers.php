<?php
namespace App\Library;


use Html;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/18/2016
 * Time: 3:14 PM
 */
class Helpers
{




    public static function Encrypt($string,$secret_key="") {
        $output = "";

        $encrypt_method = "AES-256-CBC";
        if($secret_key==null ||$secret_key==""){
            $secret_key = 'keymahoa';
        }
        $secret_iv = 'hash';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function Decrypt($string,$secret_key="") {
        $output = "";

        $encrypt_method = "AES-256-CBC";
        if($secret_key==null ||$secret_key==""){
            $secret_key = 'keymahoa';
        }
        $secret_iv = 'hash';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        if($output==false){
            return "";
        }
        return $output;
    }









    //active link function
    public static function SetActiveLink($path, $active = 'active')
    {

        return call_user_func_array('Request::is', (array)$path) ? $active : '';
//        		if(is_array($route))
//        		{
//        			return in_array(Request::path(), $route) ? 'active' : '';
//        		}
//        		return Request::path() == $route ? 'active' : '';
    }




    public static function rand_string($length)
    {
        $str = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {

            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }

    public static function rand_num_string($length)
    {
        $str = '';
        $chars = "0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {

            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }



    public static function FormatDateTime($format, $value)
    {
        //'d/m/Y'
        //'d/m/Y H:i:s'

        $result = date($format, strtotime($value));
        if ($result != "01/01/1970") {
            return $result;
        } else {
            return "";
        }
    }


    public static function ConvertToAgoTime($time)
    {
        $time = strtotime($time);

        $time = time() - $time; // to get the time since that moment

        if ($time == 0) {
            return "Vừa xong";
        }
        $tokens = array(
            31536000 => 'năm',
            2592000 => 'tháng',
            604800 => 'tuần trước',
            86400 => 'ngày trước',
            3600 => 'giờ trước',
            60 => 'phút trước',
            1 => 'giây trước',

        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? '' : '');
        }

    }


    public static function LimitString($text, $limit)
    {

        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function getNWords($string, $n = 5, $withDots = true)
    {
        $excerpt = explode(' ', strip_tags($string), $n + 1);
        $wordCount = count($excerpt);
        if ($wordCount >= $n) {
            array_pop($excerpt);
        }
        $excerpt = implode(' ', $excerpt);
        if ($withDots && $wordCount >= $n) {
            $excerpt .= '...';
        }
        return $excerpt;
    }



    //build for dropdownlist
    public static function buildMenuDropdownList($dataCategory, $selected, $idparrent = 0, $stringSpecial = "")
    {
        $result = null;


        foreach ($dataCategory as $item) {
            if ($item->parrent_id == $idparrent) {
                $checked = "";
                foreach ((array)$selected as $key => $value) {
                    if ($value == $item->id) {
                        $checked = "selected";
                        break;
                    }
                }
                $result .= "<option value='" . $item->id . "'" . $checked . ">" . Html::entities($stringSpecial . ' ' . $item->title) . "</option>";

                $result .= self::buildMenuDropdownList($dataCategory, $selected, $item->id, $stringSpecial . "---");
            }
        }
        return $result;
    }

    public static function GetChildrenCategory($menu, $parrent_id)
    {

        $result = null;
        foreach ($menu as $item)
            if ($item->parrent_id == $parrent_id) {
                $result .= ',' . $item->id;
                $result .= self::GetChildrenCategory($menu, $item->id);

            }
        return $result ? "$result" : null;
    }






}