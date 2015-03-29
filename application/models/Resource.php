<?php
class Resource {
    public static function get($res) {
        $resources = Array(
        'username'=>'نام کاربری',
        'yearly vacation'=>'مرخصی سالانه',
        
        );
        return $resources[$res];         
    }

}
