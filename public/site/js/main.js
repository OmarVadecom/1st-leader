
$(document).ready(function () {


    $('.btn-active').click(function () {
        var id = $(this).attr('id');
        if($(window).width() < 800)
        {
            $('.'+id).slideToggle().css({'display': 'inherit', 'position': 'inherit', 'left': '0', 'opacity':'1','visibility':'visible' });

        } else {
            $('.'+id).css({'display': 'none', 'position': 'absolute' })
        }
    })

    $('.btn-footer').click(function () {
        var id = $(this).attr('id');
        $('.'+id).slideToggle();
    })

    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 120) {
            $('.navbar').addClass('fixed-nav');
        } else {
            $('.navbar').removeClass('fixed-nav');
        }
    });

    new WOW().init();

    $(function () {
        $("#demo").wordsrotator({
        words: ['احترافى','جذاب','متوافق مع الموبايل'], // Array of words, it may contain HTML values
        randomize: false, //show random entries from the words array
        stopOnHover: false, //stop animation on hover
        changeOnClick: false, //force animation run on click
        animationIn: "flipInY", //css class for entrace animation
        animationOut: "flipOutY", //css class for exit animation
        speed: 2000 // delay in milliseconds between two words
        });
        $("#demo").css('background-color', '#f00');

        });

    $('.carousel-item').css('transition', '0.5s ease-out');

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true,
                loop:false
            }
        }
    })

});
