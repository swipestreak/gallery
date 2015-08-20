<?php

class StreakGallery_Module extends CrackerjackModule {
    private static $requirements = array(
        self::RequireAfterInit => array(
            'lib/elastislide/jquerypp.custom.js',
            'lib/elastislide/jquery.elastislide.js',
            'lib/imagezoom/jquery.imagezoom.js',
            'js/swipestreak-gallery.js',
            'lib/elastislide/elastislide.css',
            'lib/imagezoom/imagezoom.css',
            'css/swipestreak-gallery.css'
        )
    );

    public static function module_path($append = '') {
        return Controller::join_links(
            ltrim(static::config()->get('module_path') ?: Director::makeRelative(realpath(__DIR__ . '/../')), '/'),
            $append
        );
    }
}