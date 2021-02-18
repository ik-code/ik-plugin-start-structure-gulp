<?php


namespace Inc\Api\Callbacks;


use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{

    public function adminDashboard(){
        return require_once ("$this->plugin_path/templates/admin/admin.php");
    }

    public function adminCpt()
    {
        return require_once( "$this->plugin_path/templates/admin/cpt.php" );
    }

    public function adminTaxonomy()
    {
        return require_once( "$this->plugin_path/templates/admin/taxonomy.php" );
    }

    public function adminWidget()
    {
        return require_once( "$this->plugin_path/templates/admin/widget.php" );
    }

    public function ikOptionsGroup($input)
    {
        return $input;
    }

    public function ikAdminSection()
    {
        echo 'Check this beautiful section!';
    }

    public function ikTextExample()
    {
        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
    }

    public function ikFirstName()
    {
        $value = esc_attr( get_option( 'first_name' ) );
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write Your First Name!">';
    }


}