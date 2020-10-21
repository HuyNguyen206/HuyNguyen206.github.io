$(function(){
    $('.select-all').change(function(){
        // if($(this).is(':checked'))
        // {
        //     $(this).parent().parent().find('input[type=checkbox]').attr('checked', true)
        // }
        // else
        // {
        //     $(this).parent().parent().find('input[type=checkbox]').attr('checked', false)
        // }
        $(this).parent().parent().find('input[type=checkbox]').prop('checked',  $(this).prop('checked'))

    })
    $('.select-all-admin').change(function(){
        // console.log(123);
        $('.action, .select-all').prop('checked', $(this).prop('checked'));
    })
})
