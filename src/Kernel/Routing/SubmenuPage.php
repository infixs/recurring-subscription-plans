<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Http\Request;
use InfixsRSP\Support\Str;
use InfixsRSP\WP;

WP::show_errors();

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class SubmenuPage extends Menu
{
    /**
     * Add Submenu page
     *
     * @since 1.0.0
     * @param string $menu
     * @param string $menu_title
     * @param string $capability
     * @param string $slug
     * @param string $icon
     * @param string $position
     * @return \Infixs\Routing\MenuPage
     */
    public static function add( $menu, $menu_title, $capability, $slug, $position = null )
    {
        $instance = static::getInstance( $slug );
        $instance->parent_menu = $menu;
        $instance->page_title = $menu_title;
        $instance->menu_title = $menu_title;
        $instance->capability = $capability;
        $instance->slug = $slug;
        $instance->position = $position;

        WP::add_action('admin_menu', $instance, 'register_menu_page' );

        return $instance;
    }

    /**
     * Register menu page
     *
     * @since 1.0.0
     * @return void
     */
    public function register_menu_page()
    {
        add_submenu_page( 
            $this->parent_menu->getSlug(),
            $this->page_title, 
            $this->menu_title, 
            $this->capability,
            $this->slug, 
            [$this, 'parse_request'],
            $this->position
        );
    }    
}