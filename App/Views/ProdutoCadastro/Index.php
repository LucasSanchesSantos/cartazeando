<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-tv me-2"></i> Produtos</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>produtoCadastro/cadastro"><i class="bi bi-tv me-2"></i> Novo produto</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="produtoCadastroTable">
        <thead>
            <tr>
                <th class="text-center align-middle">Código do produto</th>
                <th class="text-center align-middle">Cor</th>
                <th class="text-center align-middle">Voltagem</th>
                <th class="text-center align-middle">Descrição</th>
                <th class="text-center align-middle">Preço venda</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['produtoCadastro'] as $produtoCadastro) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $produtoCadastro['id_produto'] ?></td>
                    <td class="text-center align-middle"><?= $produtoCadastro['cor'] ?></td>
                    <td class="text-center align-middle"><?= $produtoCadastro['voltagem'] ?></td>
                    <td class="text-center align-middle"><?= $produtoCadastro['produto'] ?></td>
                    <td class="text-center align-middle">R$ <?= number_format($produtoCadastro['preco_venda'], 2, ',', '.')?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>produtoCadastro/edicao?id=<?= $produtoCadastro['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger delete-button" href="<?= URL ?>produtoCadastro/deletar?id=<?= $produtoCadastro['id'] ?>">
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

