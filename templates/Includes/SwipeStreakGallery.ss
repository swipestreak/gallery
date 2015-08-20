<div class="swipestreak-gallery">
    <% if StreakGalleryImages %>
        <div class="ssg-main-image">
        <% with StreakGalleryImages.First %>
            <img id="swipeStreakGalleryImage" src="$Filename"/>
        <% end_with %>
        </div>
        <div class="ssg-carousel">
            <ul id="swipeStreakGalleryCarousel" class="ssg-thumbs">
                <% loop StreakGalleryImages %>
                    <li data-index="$Pos" data-pid="$ProductID" data-vid="$VariationID" data-oid="$OptionID" data-aid="$AttributeID">
                        <a href="#">
                            <img data-largeimg="$Filename" src="$Filename"/>
                        </a>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    <% end_if %>
</div>