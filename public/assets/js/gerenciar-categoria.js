document.addEventListener( 'DOMContentLoaded', function() {

    const botoesExcluir = document.querySelectorAll('.excluir-categoria');
    botoesExcluir.forEach( botao => {
        botao.addEventListener( 'click', function(event) {
            event.preventDefault();

            const idCategoria = botao.dataset.idCategoria;
            const url = `/categoria/excluir/${idCategoria}`;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then( response =>
                response.json()
            ).then( data => {
                alert( data.message );
                if( data.status == 'success' ){
                    window.location.reload();
                }
            }).catch( error => {
                alert('Houve um erro interno.')
            });
        });
    });
});