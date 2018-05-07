/**
 * background.js
 *
 * Adapted from https://css-tricks.com/perfect-full-page-background-image/#article-header-id-3
 *
 * Allows us to use responsive background images through a mixture of img tags
 * with srcset attributes (generated by wordpress), CSS to display them as
 * fullscreen background images, and JS to ensure that they cover the screen
 * regardless of image and browser aspect ratios.
 *
 */


$(window).on('load', function() {
    var aspectRatio
      , $bg = $('.background')
      , $window = $(window)
    ;

    if ($bg.length === 0) {
        return;
    } else {
        aspectRatio = $bg.width() / $bg.height();
        $window.resize(throttle(resizeBackground, 250))
            .trigger('resize');
    }

    function resizeBackground() {
        var stretchHorizontal = $window.width() / $window.height() > aspectRatio;
        $bg.toggleClass('stretch-horizontal', stretchHorizontal)
            .toggleClass('stretch-vertical', !stretchHorizontal);
    }
});