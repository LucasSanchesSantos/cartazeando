<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Cores</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>cor/cadastro"><i class="bi bi-person-add"></i> Cadastrar nova cor</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="cor">
        <thead>
            <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Cor</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['cor'] as $cor) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $cor['id'] ?></td>
                    <td class="text-center align-middle"><?= $cor['descricao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>cor/edicao?id=<?= $cor['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="<?= URL ?>cor/deletar?id=<?= $cor['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>