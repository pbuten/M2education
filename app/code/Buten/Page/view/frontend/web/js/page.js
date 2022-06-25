define([
    "jquery"
    ], function ($) {
    "use strict";
    return function (config, element) {
        console.log("Achtung!!!!");
        $('h1').css({'color':'red'});
        $('.logo').attr('aria-label', 'big fish');
        $('.logo').on('mouseenter', function (){
            $('.logo').css({'background':'black'});
        });
        $('.logo').on('mouseleave', function (){
            $('.logo').css({'background':'#ffffff00'});
        });
    }
    }
)
