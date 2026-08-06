$(document).ready(function(){
    var show = 1;

    $('.show').on('click',function(){

        if(show == 1)
        {
            $('.content-menu').addClass("content-menu2");
            show = 0;
        }
        else
        {
            $('.content-menu').removeClass("content-menu2");
            show = 1;
        }
        
    })
})

//Created with human intelligence by @jkarreno 2023 - 2024 - 2026
//May the force be with you
//move your stars
//be prepared