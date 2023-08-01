<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-1">Listagem de equipments</h1>
            <a href="<?php echo URL_BASE . "Equipment/create" ?>" class="btn btn-primary mb-3">Adicionar equipment</a>
            <hr>
            <input class="mb-1" type="text" id="filtro" placeholder="Filtrar por...">
            <table id="tabela" class="table table-bordered">
                <thead>
                    <tr>                        
                        <th>imagem 1</th>
                        <th>imagem 2</th>
                        <th>Nome do Equipamento</th>
                        <th>Description</th>
                        <th>Preço por dia</th>
                        <th>Disponibilidade</th>

                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipments as $item) { ?>
                        <tr>
                            <td>
                                <?php if (isset($equipments->img1)) { ?>
                                    <img class="img-thumbnail" width="300" src="<?php echo (URL_IMAGEM . $equipments->img1) ?>">
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (isset($equipments->img2)) { ?>
                                    <img class="img-thumbnail" width="300" src="<?php echo (URL_IMAGEM . $equipments->img2) ?>">
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $equipments->equipments_name; ?>
                            </td>
                            <td>
                                <?php echo $equipments->description; ?>
                            </td>
                            <td>
                                <?php echo $equipments->price_per_day; ?>
                            </td>
                            <td>
                                <?php echo $equipments->availabilities_name; ?>
                            </td>
                          
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <ul id="paginacao" class="pagination"></ul>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja deletar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="modal_ok" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script>
    $(document).ready(function () {
        $('#filtro').keyup(function () {
            filtrarTabela($(this).val());
        });

        function filtrarTabela(filtro) {
            $('#tabela tbody tr').hide();
            $('#tabela tbody tr').each(function () {
                if ($(this).text().toLowerCase().indexOf(filtro.toLowerCase()) !== -1) {
                    $(this).show();
                }
            });
        }

        // Configuração da paginação
        var linhasPorPagina = 5;
        var totalLinhas = $('#tabela tbody tr').length;
        var totalPaginas = Math.ceil(totalLinhas / linhasPorPagina);

        for (var i = 1; i <= totalPaginas; i++) {
            $('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>').appendTo('#paginacao');
        }

        $('#tabela tbody tr').hide();
        $('#tabela tbody tr').slice(0, linhasPorPagina).show();

        $('#paginacao li:first-child').addClass('active');

        $('#paginacao li a').click(function () {
            var pagina = $(this).text();
            var inicio = (pagina - 1) * linhasPorPagina;
            var fim = inicio + linhasPorPagina;

            $('#tabela tbody tr').hide();
            $('#tabela tbody tr').slice(inicio, fim).show();

            $('#paginacao li').removeClass('active');
            $(this).parent('li').addClass('active');
        });
    });

    var csrfToken = <?php echo json_encode($_SESSION['csrf_token']); ?>;
    // Selecionar todos os botões com a classe 'deletar'
    var buttons = document.querySelectorAll('.deletar');
    var idLinha = 0;
    // Adicionar um manipulador de evento para cada botão
    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Obter o valor do atributo 'id_linha'
            idLinha = button.getAttribute('id_linha');
        });
    });

    var deletButton = document.getElementById('modal_ok');
    // Adicionar um manipulador de evento para o clique no botão de fechar
    deletButton.addEventListener('click', function () {
        // Função para lidar com o clique no botão

        // Criar uma nova instância do objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar a requisição
        xhr.open('POST', '<?php echo URL_BASE . 'Banner/delete'; ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Preparar os dados do formulário
        var formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('id', idLinha);
        formData.append('csrf_token', csrfToken);

        // Enviar a requisição
        xhr.send(new URLSearchParams(formData));

        // Tratar a resposta da requisição
        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.href = '<?php echo URL_BASE . 'Banner'; ?>';
            } else {

            }
        };

    });
</script>