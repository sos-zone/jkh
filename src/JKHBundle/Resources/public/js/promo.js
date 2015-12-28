/** slider start */
$(function(){
    var li = $(".promo_slider-wrapper li");
    var len = li.length;
    for(var i=0;i<len;i++){
        $(li[i]).attr('slide', i);
    }
    
    $(".promo_slider-polzyn").css({left:'-1px'});
    $(".promo_slider-wrapper").jCarouselLite({
        btnNext: ".promo_slider-wrapper-button .next",
        btnPrev: ".promo_slider-wrapper-button .prev",
        scroll: 1,
        visible: 2,
        auto: 1600,
        speed: 600,
        afterEnd: function(a) {
            if($(a[0]).attr('slide') == 0){
                $(".promo_slider-polzyn").animate({left:'-1px'}, 400);
            }
            else{
                $(".promo_slider-polzyn").animate({left:($(a[0]).attr('slide')*(56/(len-1)))+'px'}, 400);
            }            
        }
    });
});
/** slider end */

/** navs start */
var pages = [];
$(function(){
    $(window).bind('scroll', function(){
        updateNav();
    });    
    $(".nav-button").bind("click", function(){
        $.scrollTo( $(this).attr('href'), 800);
    });
    
    var p =  $(".page a");
    for(var i=0;i<p.length;i++){
        var e = $($(p[i]).attr('href'));
        if(e){
            pages[pages.length] = e.offset().top;
        }
    }
    updateNav();
});

function updateNav(){
    var c = 0;
    var st = $(document).scrollTop();
    for(var i=0;i<pages.length;i++){
        if(pages[i]<=st && (!pages[i+1] || st<pages[i+1])){
            c = i;
            $(".pagination .page").removeClass('activ');
            $('#p'+(i+1)).parent().addClass('activ');
        }
    }
    
    if(c == (pages.length - 1)){
        $("#last").attr('href', '#link1');
    }
    else{
        $("#last").attr('href', '#link' + (c + 2));
    }

    if(c == 0){
        $("#first").attr('href', '#link' + (pages.length));
    }
    else{
        $("#first").attr('href', '#link' + (c));
    }
}

/** navs end */
