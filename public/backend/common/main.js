$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('.delete').click(function(event){
        event.preventDefault();
        let currentRowDelete = $(this);
        let urlRequest = currentRowDelete.data('url-delete')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'get',
                    url: urlRequest,
                    success: function(data){
                        if(data.code == 200)
                        {
                            currentRowDelete.parent().parent().parent().remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                        else
                        {
                            Swal.fire(
                                'Fail!',
                                'Can not delete!',
                                'error'
                            )
                        }
                    },
                    error: function (data) {
                        Swal.fire(
                            'Can not send request to server!',
                            'Error',
                            'error'
                        )
                    }
                })
            }

        })

    })

});
