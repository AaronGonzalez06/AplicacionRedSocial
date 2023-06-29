var url = 'http://instragram.com.devel';
window.addEventListener("load", function () {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //cambiar de negro a rojo
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/rojo.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('he dado like');
                    }

                }
            });


            dislike();
        });
    }
    like();
    //cambiar de rojo a negro
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+ '/img/negro.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('he dado dislike');
                    }

                }
            });
            like();
        });
    }
    dislike();
    
    //para el buscador
    $('#buscador').submit(function(e){
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });
    
});