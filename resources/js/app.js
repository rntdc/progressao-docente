import './bootstrap';
import DataTable from 'datatables.net-dt';

let table = new DataTable('#myTable', {
    responsive: true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/pt-PT.json',
    },
});

$('.js-delete').on('click',function(e){
    e.preventDefault();

    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const deleteUrl = $(this).attr('data-url');
    const itemId = $(this).data('item');
    const subitemId = $(this).data('subitem');
    const questionId = $(this).data('question');
    const message = $(this).attr('data-message');
    const back = $(this).attr('data-back');

    Swal.fire({
        title: message,
        text: 'Essa ação não pode ser desfeita!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Não, cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                dataType: 'json',
                data: {
                    _token: csrfToken, // Include the CSRF token
                    item_id: itemId,
                    subitem_id: subitemId,
                    question_id: questionId,
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Operação bem sucedida.',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(response.back) {
                                window.location.replace(back);
                            } else {
                                location.reload();
                            }
                        }
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Erro!',
                        text: error.responseJSON.message
                        ,
                        icon: 'error',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });

                    console.log(error);
                },
            });
        }
    });
});


