<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Tipo de cartaz</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>tipoCartaz/cadastro"><i class="bi bi-person-add"></i> Novo tipo de cartaz</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="tipoCartaz">
        <thead>
            <tr>
                <th class="text-center align-middle">Tipo cartaz</th>
                <th class="text-center align-middle">Tamanho inicial</th>
                <th class="text-center align-middle">Tamanho final</th>
                <th class="text-center align-middle">Quantidade de folhas</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['tipoCartaz'] as $tipoCartaz) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $tipoCartaz['descricao'] ?></td>
                    <td class="text-center align-middle"><?= $tipoCartaz['dimensao_inicial'] ?></td>
                    <td class="text-center align-middle"><?= $tipoCartaz['dimensao_final'] ?></td>
                    <td class="text-center align-middle"><?= $tipoCartaz['qtd_folhas'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>tipoCartaz/edicao?id=<?= $tipoCartaz['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger delete-button" href="<?= URL ?>tipoCartaz/deletar?id=<?= $tipoCartaz['id'] ?>">
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

