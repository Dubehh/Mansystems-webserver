/**
 * Created by Eelco on 21-11-2017.
 */
$(function(){
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
});