<?php


namespace Inc\Base;


class Enqueue extends BaseController
{

    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_front'));

    }


       public function enqueue_admin()
        {
            // enqueue all our scripts
            wp_enqueue_style('ikmypluginstyle-admin', $this->plugin_url . 'assets/ik-myplugin-admin.css');
            wp_enqueue_script('ikmypluginscript-admin', $this->plugin_url . 'assets/ik-myplugin-admin.js', array(), '1.0.0', true);

        }

        public function enqueue_front()
        {
            // enqueue all our scripts
            wp_enqueue_style('ikmypluginstyle-front', $this->plugin_url . 'assets/ik-myplugin-front.css');
            wp_enqueue_script('ikmypluginscript-front', $this->plugin_url . 'assets/ik-myplugin-front.js', array(), '1.0.0', true);

        }


}