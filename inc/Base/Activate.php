<?php

namespace Inc\Base;

class Activate
{
    public static function activate(){
        //useful when:
        //1.generated a CPT
        //$this->custom_post_type();
        //2. flush rewrite rules to update URL\s

        flush_rewrite_rules();

        if( get_option( 'ik_plugin') ){
            return;
        }

        $default = array();

        update_option( 'ik_plugin', $default );



    }
}