<?php

namespace Inc\Base;

class Deactivate
{
    public static function deactivate()
    {
        //useful when:
        //1. flush rewrite rules to update URL\s
        flush_rewrite_rules();
    }
}