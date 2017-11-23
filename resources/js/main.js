/**
 * Created by Eelco on 21-11-2017.
 */
$(function(){
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });

    $("#toggleNav").click(function(){
        var target = $(this).attr('data-target');
        $(target).slideToggle("slow");
    });
});