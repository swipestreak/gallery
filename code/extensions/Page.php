<?php

class StreakGallery_PageExtension extends SiteTreeExtension {
    // set in config the source relationship names for images which show in the gallery
    private static $streak_gallery_image_sources = array();

    public function StreakGalleryImages() {
        $images = new ArrayList();

        foreach ($this->getImageSources() as $relationshipName) {
            if (false !== (strpos($relationshipName, '.'))) {

                $path = explode('.', $relationshipName);

                $this->walkRelationshipChain($this->owner, $images, $path, reset($path), $this->owner);

            } else if ($this->owner->hasMethod($relationshipName)) {

                $images->merge($this->owner->$relationshipName() ?: new ArrayList());

            } else {

                continue;
            }
        }
        return $images;
    }

    protected function walkRelationshipChain(DataObject $from, ArrayList $list, array $parts, $lastPart, $lastItem) {
        $part = array_shift($parts);

        if (!$from->hasMethod($part)) {
            // error, no such part of relationship chain
            return false;
        }
        if (count($parts)) {
            foreach ($from->$part() as $item) {
                $this->walkRelationshipChain($item, $list, $parts, $part, $item);
            }
        } else {
            $images = $from->$part()->toNestedArray();

            // mark the images with a source from relationship and ID
            /** @var Image $image */
            foreach ($images as &$image) {
                if ($lastItem instanceof Variation) {
                    $options = $lastItem->Options();

                    foreach ($options as $option) {
                        $image['ProductID'] = $lastItem->Product()->ID;
                        $image['VariationID'] = $lastItem->ID;
                        $image['OptionID'] = $option->ID;
                        $image['AttributeID'] = $option->AttributeID;
                    }
                }

            }
            $list->merge(new ArrayList($images));
        }
        return true;
    }
    protected function getImageSources() {
        return Config::inst()->get(__CLASS__, 'streak_gallery_image_sources') ?: array();
    }
}