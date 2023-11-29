<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-lightning me-2"></i> Voltagem</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>voltagem/cadastro"><i class="bi bi-lightning me-2"></i> Nova voltagem</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="voltagem">
        <thead>
            <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Voltagem</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['voltagem'] as $voltagem) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $voltagem['id'] ?></td>
                    <td class="text-center align-middle"><?= $voltagem['descricao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>voltagem/edicao?id=<?= $voltagem['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="<?= URL ?>voltagem/deletar?id=<?= $voltagem['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>