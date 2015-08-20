<?php
class StreakGallery_PageControllerExtension extends Extension {
    public function onAfterInit() {
        StreakGallery_Module::requirements(CrackerjackModule::RequireAfterInit);
        Requirements::themedCSS('swipestreak-gallery.css');
    }
}