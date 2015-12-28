$(function(){
    $('input[type=file]').styler();
    $('.add-file').bind('click', function(){
        $(this).before('<input class="input-file" type="file"><br>');
        $('input[type=file]').styler();
        return false;
    });
});