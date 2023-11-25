<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Tipo de pagamentos</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>tipoPagamento/cadastro"><i class="bi bi-person-add"></i> Novo tipo de pagamento</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="tipoPagamento">
        <thead>
            <tr>
                <th class="text-center align-middle">ID tipo pagamento</th>
                <th class="text-center align-middle">Tipo pagamento</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['tipoPagamento'] as $tipoPagamento) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $tipoPagamento['id'] ?></td>
                    <td class="text-center align-middle"><?= $tipoPagamento['descricao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>tipoPagamento/edicao?id=<?= $tipoPagamento['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger delete-button" href="<?= URL ?>tipoPagamento/deletar?id=<?= $tipoPagamento['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="confirmacaoExclusaoModal" tabindex="-1" aria-labelledby="confirmacaoExclusaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmacaoExclusaoModalLabel">Confirmar exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja realmente fazer essa exclusão?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmarExclusao" class="btn btn-danger">Confirmar</a>
            </div>
        </div>
    </div>
</div>

