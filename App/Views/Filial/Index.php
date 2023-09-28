<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Filiais</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>filial/cadastro"><i class="bi bi-person-add"></i> Nova filial</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="filial">
        <thead>
            <tr>
                <th class="text-center align-middle">Número filial</th>
                <th class="text-center align-middle">Empresa</th>
                <th class="text-center align-middle">Cidade</th>
                <th class="text-center align-middle">UF</th>
                <th class="text-center align-middle">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['filial'] as $filial) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $filial['numero'] ?></td>
                    <td class="text-center align-middle"><?= $filial['empresa'] ?></td>
                    <td class="text-center align-middle"><?= $filial['cidade'] ?></td>
                    <td class="text-center align-middle"><?= $filial['uf'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>filial/edicao?id=<?= $filial['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>