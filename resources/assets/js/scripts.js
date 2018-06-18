;$(document).ready(function(){
    
    if($('textarea').is('.ckeditor'))
    {
        CKEDITOR.replaceAll();
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#categoryForm').on('submit', function(event){
        event.preventDefault();

        $.ajax({
            type  : $(this).attr('method'),
            url   : $(this).attr('action'),
            data  : $(this).serialize(),
            dataType : 'json',
            success:function(data){
                if(data.success)
                {
                    $('#categoryComments h4').after(data.success);
                    $('#categoryComments h4').html(data.count+' category comments');
                    $('#commentErrors').html('');
                    $('#categoryForm textarea[name="content"]').val('');
                }
                else if(data.error)
                {
                    $('#commentErrors').html(data.error);
                }
            }
        });
    });
    
    $('#postForm').on('submit', function(event){
        event.preventDefault();

        $.ajax({
            type  : $(this).attr('method'),
            url   : $(this).attr('action'),
            data  : $(this).serialize(),
            dataType : 'json',
            success:function(data){
                if(data.success)
                {
                    $('#postComments h4').after(data.success);
                    $('#postComments h4').html(data.count+' post comments');
                    $('#commentErrors').html('');
                    $('#postForm textarea[name="content"]').val('');
                }
                else if(data.error)
                {
                    $('#commentErrors').html(data.error);
                }
            }
        });
    });
});



