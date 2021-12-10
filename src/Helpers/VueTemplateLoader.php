<?php
namespace RecurringSubscriptionPlans\Helpers;

defined( 'ABSPATH' ) || exit;

class VueTemplateLoader
{
    public static function getManifest( $file )
    {
        $content = file_get_contents( $file );
        return json_decode($content, true);
    }
}