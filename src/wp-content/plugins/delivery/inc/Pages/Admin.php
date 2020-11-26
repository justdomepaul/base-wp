<?php
/**
 * @package  Delivery
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
 *
 */
class Admin extends BaseController
{
    public $settings;

    public $callbacks;

    public $pages = array();

    public $subPages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubPages();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subPages )->register();
    }

    public function setPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Alecaddd Plugin',
                'menu_title' => 'Alecaddd',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_plugin',
                'callback' => array( $this->callbacks, 'adminDashboard' ),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubPages()
    {
        $this->subPages = array(
            array(
                'parent_slug' => 'alecaddd_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_cpt',
                'callback' => array( $this->callbacks, 'adminCpt' )
            ),
            array(
                'parent_slug' => 'alecaddd_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_taxonomies',
                'callback' => array( $this->callbacks, 'adminTaxonomy' )
            ),
            array(
                'parent_slug' => 'alecaddd_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'alecaddd_widgets',
                'callback' => array( $this->callbacks, 'adminWidget' )
            )
        );
    }
}