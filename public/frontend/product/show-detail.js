$(function(){
    function addToCartWithQuantity(quantity, element) {
        var url_update = element.data('url');
        url_update = url_update + '/' + quantity;
        $.ajax({
            type: 'GET',
            url: url_update,
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    Swal.fire(
                        'Success!',
                        'The product already is added to cart!',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Error!',
                        data.message,
                        'error'
                    )
                }

            },
            error: function (data) {
                Swal.fire(
                    'Error!',
                    data.message,
                    'error'
                )
            }

        })

    }


    $(document).on('click', '.cart', function(){
        var quantity = $('.quantity').val();
        console.log(quantity)
        if(isNaN(quantity))
        {
            alert('Please input your quantity')
        }
        else
        {
            addToCartWithQuantity(quantity, $(this))
        }

    })
})
