(function($) {
/*
 * Debounce and throttle functions 
 */

    //From underscore
    var now = Date.now || function() {
        return new Date().getTime();
    };

    //Taken from underscore via https://davidwalsh.name/javascript-debounce-function
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) {
                    func.apply(context, args);
                }
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) {
                func.apply(context, args);
            }
        };
    }

    //Also from underscore (http://underscorejs.org/docs/underscore.html)
    function throttle(func, wait, options) {
        var context, args, result;
        var timeout = null;
        var previous = 0;
        if (!options) {
            options = {};
        }
        var later = function() {
            previous = options.leading === false ? 0 : now();
            timeout = null;
            result = func.apply(context, args);
        if (!timeout) {
            context = args = null;
        }
        };
        return function() {
            var n = now();
            if (!previous && options.leading === false) {
                previous = n;
            }
            var remaining = wait - (n - previous);
            context = this;
            args = arguments;
            if (remaining <= 0 || remaining > wait) {
            if (timeout) {
                clearTimeout(timeout);
                timeout = null;
            }
            previous = n;
            result = func.apply(context, args);
            if (!timeout) {
                context = args = null;
            }
            } else if (!timeout && options.trailing !== false) {
                timeout = setTimeout(later, remaining);
            }
            return result;
        };
    }

/*
 * Scrolling navigation
 */
    $(window).on("load", function() {
        var sectionHeights = [];
        var sectionNames = [];
        var fixedOn = $(".nav").offset().top;
        if (fixedOn === 0) {
            fixedOn = $(window).height();
        }
        // console.log(fixedOn);
        getSectionHeights();


        //Mobile menu

        function bindNav() {
            if ($(window).width() < 800) {
                $(".nav a").click(openNav);
            }
        }

        function closeNav() {
            $("#nav").removeClass("open");
            bindNav();
        }

        function openNav() {
            if ($(this).parent().hasClass("selected")) {
                $("#nav").addClass("open");
                $(this).click(closeNav);
                return false;
            }
            else {
                closeNav();
            }
        }


        function onResize() {
            getSectionHeights();
            bindNav();
        }

        $(window).resize(debounce(onResize, 100));
        bindNav();

        //Get offset of each section
        function getSectionHeights() {
            sectionHeights = [];
            $(".section").each(function(i) {
                sectionHeights[i] = $(this).offset().top;
                sectionNames[i] = this.id;
            });
            sectionHeights.push($(document).height());
            // console.log("section heights: ", sectionHeights);
        }

        //Highlight current section in nav
        function highlightMenuItem() {
            var location = $(window).scrollTop() + 40;
            var height = $(document).height();
            for (var i=0; i<sectionHeights.length; i++) {
                if (location >= sectionHeights[i] && location < sectionHeights[i+1]) {
                    // console.log(location);
                    $(".selected").removeClass("selected");
                    $("nav>ul li:nth-child(" + (i+1) + ")").addClass("selected");
                    getSectionHeights();
                    break;
                }
            }
        }

        $(window).scroll(function() {
            // console.log("scrollTop: ", $(window).scrollTop(), " fixedOn: ", fixedOn);
            if ($(window).scrollTop() > fixedOn) {
                $("#header-wrapper").removeClass("before-scroll").addClass("after-scroll");
                throttle(highlightMenuItem(), 250);
                if (!$(".selected").length) {
                    $(".nav li:first-child").addClass("selected");
                }
            }

            else if ($(window).scrollTop() <= fixedOn) {
                $("#header-wrapper").removeClass("after-scroll").addClass("before-scroll");
                $(".nav li.selected").removeClass("selected");
                if ($(window).width() < 800) {
                    fixedOn = $(window).height();
                }
                else {
                    fixedOn = $(".nav").offset().top;
                }
            }
        });

        $(window).trigger("scroll");

        //Animate scroll to page section
        $(".nav a").click(function() {
            var dest = $($(this).attr("href")).offset().top;
            var distance = Math.abs(dest - $(window).scrollTop());
            var scrollSpeed = distance/2.5;
            $('html, body').animate({
                scrollTop: dest
            }, scrollSpeed, highlightMenuItem);
            return false;
        });

        //Scroll to top
        $('.logo').click(function() {
            var scrollSpeed = $(window).scrollTop()/2.5;
            if ($(".selected").length) {
                $('html, body').animate({
                    scrollTop: 0
                }, scrollSpeed);
            }
        });
    });
/*
 * AJAX contact form
 */
    
    var responseDiv = $('#contact-form-response');
    var contactForm = $('#contact-form');
    var wrapper = $(contactForm).parent();
    $(contactForm).submit(function(e) {
        e.preventDefault();

        var data = contactForm.serialize();
        // console.log("data: ", data);
        $(wrapper).addClass('waiting');
        $.ajax({
            type: 'POST',
            url: $(contactForm).attr('action'),
            data: data
        }).done(function(data) {
            // console.log("success\n", data);
            $(responseDiv).removeClass('error');
            $(responseDiv).addClass('success');
            $(wrapper).removeClass('waiting');
            $(contactForm).hide();
            $(responseDiv).text(data);
        }).fail(function(data){
            // console.log("fail\n", data);
            $(wrapper).removeClass('waiting');
            $(responseDiv).addClass('error');

            var response = data.responseText;
            if (response.responseText !== '') {
                $(responseDiv).text(response);
            } else {
                $('#responseDiv > p.unknown-error').show();
            }
        });
    });

    //Google recaptcha setup
    function recaptchaCallback() {
        $('.g-recaptcha').hide();
        $('.contact-form-wrapper button').show();
    }

/*
 * Readmore setup
 */

    // $('.event').readmore({
    //     collapsedHeight: 300,
    //     speed: 750,
    //     moreLink: '<a href="#">Read more</a>',
    //     lessLink: '<a href="#">Hide</a>',
    //     afterToggle: getSectionHeights
    // });

/*
 * Colorful logo
 */
    $(".logo").hover(function() {
        $(this).toggleClass("hover");
    });

})(jQuery);
