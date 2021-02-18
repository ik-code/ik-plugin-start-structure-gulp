<?php


namespace Inc\Base;


class SettingsLink extends BaseController
{

    /**
     * register method
     */
    public function register()
    {
        //Creates setting link
        add_filter('plugin_action_links_' . $this->plugin_name, array($this, 'settings_link'));
    }

    /**
     * @param $links
     * @return mixed
     */
    public function settings_link($links)
    {
        //add custom settings link
        $settings_link = '<a href="admin.php?page=ik_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }



}