function refreshCheckoutButton()
{
    // console.log($('.tbody-wrapper tr:first-child').data('hasItem') )
    if($('.tbody-wrapper tr:first-child').data('hasItem') == true)
    {
        $('.check_out').removeAttr("disabled");
        console.log('Remove disabled')
    }
    else
    {
        $('.check_out').attr("disabled", "disabled");
    }
}

$(function(){
    refreshCheckoutButton()
    function updateViewCart(quantity, element) {
        var url_update = $('.cart_info').data('update');
        var id = element.parent().data('id');
        $.ajax({
            type:"GET",
            data: {id:id, quantity:quantity, couponCode : $('.coupon_code').val()},
            url: url_update,
            success: function(data){
                if(data.code === 200)
                {
                    $('.cart_info').html(data.cart_update_view);
                    refreshCheckoutButton()
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
            error: function (jqXHR, textStatus, errorThrown) {
                // alert('Internal error: ' + jqXHR.responseJSON.message)
                Swal.fire(
                    'Internal error:',
                    jqXHR.responseText,
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
                    refreshCheckoutButton()
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
            error: function (jqXHR, textStatus, errorThrown) {
                // alert('Internal error: ' + jqXHR.responseJSON.message)
                Swal.fire(
                    'Internal error:',
                    jqXHR.responseText,
                    'error'
                )
            }
        })
    }
    $(document).on('click', '.cart_quantity_delete', function (event) {
        event.preventDefault();
        updateRemoveViewCart($(this))
    })
    $(document).on('click', '.apply_coupon', function (event) {
        event.preventDefault();
        if($('.coupon_code').val() == '')
        {
            alert('Vui lòng nhập mã giảm giá!')
        }
        else
        {
            var urlCoupon = $(this).data('coupon');
            $.ajax({
                type:'GET',
                url: urlCoupon,
                data: {couponCode : $('.coupon_code').val()},
                success: function(data){
                    if(data.code === 200)
                    {
                        $('.cart_info').html(data.cart_update_view)
                        $('.remove_coupon').removeAttr('disabled')
                        refreshCheckoutButton()
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
                error: function (jqXHR, textStatus, errorThrown) {
                    // alert('Internal error: ' + jqXHR.responseJSON.message)
                    Swal.fire(
                        'Internal error:',
                        jqXHR.responseText,
                        'error'
                    )
                }
            })
        }
    })

    $(document).on('click', '.remove_coupon', function (event) {
        event.preventDefault();
            var urlCoupon = $(this).data('coupon');
            $.ajax({
                type:'GET',
                url: urlCoupon,
                success: function(data){
                    if(data.code === 200)
                    {
                        $('.cart_info').html(data.cart_update_view)
                        $('.remove_coupon').attr('disabled', true)
                        refreshCheckoutButton()
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
                error: function (jqXHR, textStatus, errorThrown) {
                    // alert('Internal error: ' + jqXHR.responseJSON.message)
                    Swal.fire(
                        'Internal error:',
                        jqXHR.responseText,
                        'error'
                    )
                }
            })
    })

})
