<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Produtos</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>produtoCadastro/cadastro"><i class="bi bi-person-add"></i> Novo produto</a>
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
                    <td class="text-center align-middle"><?= $produtoCadastro['preco_venda'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>produtoCadastro/edicao?id=<?= $produtoCadastro['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="<?= URL ?>produtoCadastro/deletar?id=<?= $produtoCadastro['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>