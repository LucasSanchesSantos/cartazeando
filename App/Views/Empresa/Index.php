<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Filiais</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>empresa/cadastro"><i class="bi bi-person-add"></i> Nova empresa</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="empresa">
        <thead>
            <tr>
                <th class="text-center align-middle">Número empresa</th>
                <th class="text-center align-middle">Empresa</th>
                <th class="text-center align-middle">CNPJ</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['empresa'] as $empresa) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $empresa['id'] ?></td>
                    <td class="text-center align-middle"><?= $empresa['descricao'] ?></td>
                    <td class="text-center align-middle"><?= $empresa['cnpj'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>empresa/edicao?id=<?= $empresa['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="<?= URL ?>empresa/deletar?id=<?= $empresa['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>