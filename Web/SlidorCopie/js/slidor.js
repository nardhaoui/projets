/*!
Slidor developers on fire
*/

//Modernizr fallback for SVG
if (!Modernizr.svg) {
    var imgs = document.getElementsByTagName('img');
    var svgExtension = /.*\.svg$/
    var l = imgs.length;
    for (var i = 0; i < l; i++) {
        if (imgs[i].src.match(svgExtension)) {
            imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
            console.log(imgs[i].src);
        }
    }
}

//define Function Exists
jQuery.fn.exists = function () { return this.length > 0; }

// jQuery to collapse the navbar on scroll
if ($(".navbar").exists()) {
    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });
}

// jQuery for page scrolling feature - requires jQuery Easing plugin
if ($('a.page-scroll').exists()) {
    $(function () {
        $('a.page-scroll').bind('click', function (event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });
}

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function () {
    $('.navbar-toggle:visible').click();
});


//change the language from URL
var address = window.location.href.toString();
var langset = Localize.getLanguage();
var res = address.match("/en");
if ((res != null)) {
    Localize.setLanguage('en')
}

//if ((res == null)) {
//    alert('fr');
//    Localize.setLanguage('fr')
//}

////language
//var langset = Localize.getLanguage();
//if (langset == 'en') {
//    var linkToChange = $(".setlang").attr('href');
//    var check = linkToChange.match("en/");
//    if ((check == null)) {
//        $(".setlang").attr("href", function (index, oldValue) {
//            alert(linkToChange + 'change');
//            return "en/" + oldValue;
//        });
//    }

//}

       