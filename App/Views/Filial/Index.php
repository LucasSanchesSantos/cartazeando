<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Filiais</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>filial/cadastro"><i class="bi bi-person-add"></i> Nova filial</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="filial">
        <thead>
            <tr>
                <th class="text-center align-middle">Id filial</th>
                <th class="text-center align-middle">Cidade</th>
                <th class="text-center align-middle">UF</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['filial'] as $filial) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $filial['id_filial'] ?></td>
                    <td class="text-center align-middle"><?= $filial['cidade'] ?></td>
                    <td class="text-center align-middle"><?= $filial['uf'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>filial/edicao?id=<?= $filial['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger delete-button" href="<?= URL ?>filial/deletar?id=<?= $filial['id'] ?>">
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

