/*
 * Scrolling navigation (and NOT a hamburger menu 😈)
 *
 * Requires jQuery and debounce/throttle functions.
 */

var nav = (function() {
    var $navWrapper = $('#header-wrapper');
    if ($navWrapper.length === 0) {
        return {
            init: function() {}
        };
    }

    var selectedClass = 'selected'
      , openClass = 'open'
      , mobileMaxWidth = 800
      , navHeight = 45
      , scrollSpeed = 2.5
      , $window = $(window)
      , $body = $('html, body')
      , $nav = $navWrapper.find('#nav')
      , $navItems = $nav.find('a')
      , $sections = $('.section')
      , $document = $(document)
      , loaded = false
      , itemIsSelected = false
      , mobileNavOpen = false
      , numSections = $sections.length
      , fixedOn = $window.height()
      , navIsFixed = $nav.offset().top || $window.height() // Use height of window if offset is 0 (ie. already scrolled)
      , $logo = $('.logo')
      , isScrolled = false
      , isMobile
      , sectionHeights
      , $currentlySelected
      , docHeight
    ;

    var bindScroll = function() {
        $window.on('scroll', throttle(onScroll, 150));
    };

    var onScroll = function() {
        var location = $window.scrollTop()
          , scrolled = location > fixedOn
        ;

        if (isScrolled !== scrolled) {
            isScrolled = scrolled;
            $navWrapper.toggleClass('after-scroll', scrolled)
                .toggleClass('before-scroll', !scrolled);
        }
        if (scrolled) {
            highlightMenuItem();
        } else if (itemIsSelected) {
            $currentlySelected.closest('li').removeClass(selectedClass);
            itemIsSelected = false;
        }
    };

    var onLoad = function() {
        docHeight = $document.height();
        loaded = true;
        $navItems.on('click.scrollTo', onNavItemClick);
        $logo.click(scrollToTop);
        getSectionHeights();
        bindScroll();
        $window.trigger('resize');
        $window.trigger('scroll');
    };

    var onResize = function() {
        if (!loaded) {
            return;
        }
        docHeight = $document.height();
        isMobile = checkMobile();
    };

    var onNavItemClick = function(ev) {
        if (!isMobile || mobileNavOpen) {
            var dest = $(ev.target.hash).offset().top
              , time = Math.abs(dest - $window.scrollTop()) / scrollSpeed;
            if (!isScrolled) {
                $window.off('scroll');
            }
            $body.animate({
                scrollTop: dest
            }, time, function() {
                bindScroll();
                $window.trigger('scroll');
            });
        }
        toggleMobileMenu();
        ev.preventDefault();
    };

    var scrollToTop = function() {
        var time = $window.scrollTop() / scrollSpeed;
        if (itemIsSelected) {
            $body.animate({
                scrollTop: 0
            }, time);
        }
    };

    var checkMobile = function() {
        return $window && ($window.width() < mobileMaxWidth);
    };


    var getSectionHeights = function() {
        sectionHeights = $sections.map(function() {
            return $(this).offset().top;
        });
        sectionHeights.push(docHeight);
    };

    var highlightMenuItem = function() {
        var location = $window.scrollTop() + navHeight;
        // Select first menu item if none is selected and we haven't reached the first section yet
        if (location < sectionHeights[0]) {
            if (!itemIsSelected) {
                $navItems.eq(0).closest('li').addClass(selectedClass);
                itemIsSelected = true;
            }
        }
        for (var i=0; i<numSections; i++) {
            if (location >= sectionHeights[i] && location < sectionHeights[i+1]) {
                var $selected = $navItems.eq(i);
                // If element is already selected, do nothing
                if ($selected.hasClass(selectedClass)) {
                    break;
                }
                // Otherwise remove class from other element and add to new one
                else {
                    if (itemIsSelected) {
                        $currentlySelected.closest('li').removeClass(selectedClass);
                    }
                    $selected.closest('li').addClass(selectedClass);
                    $currentlySelected = $selected;
                    itemIsSelected = true;
                    break;
                }
            }
        }
    };

    var toggleMobileMenu = function(ev) {
        $nav.toggleClass(openClass);
        mobileNavOpen = !mobileNavOpen;
    };

    var init = function() {
        $window.on('resize', debounce(onResize, 250));
        $window.on('load', onLoad);
    };

    return {
        init: init
    };

})();

$(function() {
    var BuildCoffeeNav = nav.init();
});
