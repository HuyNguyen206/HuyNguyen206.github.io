
function refreshOrderButton()
{
    // console.log($('.tbody-wrapper tr:first-child').data('hasItem') )
    if($('.tbody-wrapper tr:first-child').data('hasItem') == true)
    {
        $('.order-btn').removeAttr("disabled");
        $
        console.log('Remove disabled')
    }
    else
    {
        $('.order-btn').attr("disabled", "disabled");
    }
}
$(function(){
    refreshOrderButton()
    function updateViewCart(quantity, element) {
        var url_update = $('.cart_info').data('update');
        var id = element.parent().data('id');
        $.ajax({
            type:"GET",
            data: {id:id, quantity:quantity},
            url: url_update,
            success: function(data){
                if(data.code === 200)
                {
                    $('.cart_info').html(data.cart_update_view);
                    refreshOrderButton()
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        data.message,
                        'error'
                    )
                }
            },
            error: function(){
                Swal.fire(
                    'Error!',
                    data.message,
                    'error'
                )
            }
        })
    }
    $(document).on('click', '.cart_quantity_up', function(event){
        event.preventDefault();
        var quantity =  parseInt($(this).parent().find('.cart_quantity_input').val()) + 1
        // console.log(quantity)
        updateViewCart(quantity, $(this))
    })

    $(document).on('click', '.cart_quantity_down', function(event){
        event.preventDefault();
        var quantity, oldQuantity
        quantity = oldQuantity = parseInt($(this).parent().find('.cart_quantity_input').val());
        if(oldQuantity > 1)
        {
            quantity =  parseInt($(this).parent().find('.cart_quantity_input').val()) - 1
        }
        updateViewCart(quantity, $(this))
    })

    $(document).on('change', '.cart_quantity_input', function(){
        var quantity = parseInt($(this).val())
        if(isNaN(quantity))
        {
            alert('Please input your quantity')
        }
        else
        {
            updateViewCart(quantity, $(this))
        }

    })

    function updateRemoveViewCart(element) {
        var url_remove = element.data('url-remove');
        $.ajax({
            type:"GET",
            url: url_remove,
            success: function(data){
                if(data.code === 200)
                {
                    $('.cart_info').html(data.cart_update_view)
                    refreshOrderButton()
                    Swal.fire(
                        'Success!',
                         'The product is already removed',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        data.message,
                        'error'
                    )
                }
            },
            error: function(){
                Swal.fire(
                    'Error!',
                    data.message,
                    'error'
                )
            }
        })
    }
    $(document).on('click', '.cart_quantity_delete', function (event) {
        event.preventDefault();
        updateRemoveViewCart($(this))
    })

})
