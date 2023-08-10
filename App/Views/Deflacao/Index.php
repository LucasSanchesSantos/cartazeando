
<div class="table-responsive mt-2">
    <table class="table table-striped table-hover" id="tabelaDeflacao">
        <thead>
            <tr>
                <th class="text-center align-middle">Tipo pagamento</th>
                <th class="text-center align-middle">Parcela início</th>
                <th class="text-center align-middle">Parcela fim</th>
                <th class="text-center align-middle">Valor deflação</th>
                <th class="text-center align-middle">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['deflacao'] as $deflacao) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $deflacao['tipo_pagamento'] ?></td>
                    <td class="text-center align-middle"><?= $deflacao['parcela_de'] ?></td>
                    <td class="text-center align-middle"><?= $deflacao['parcela_ate'] ?></td>
                    <td class="text-center align-middle"><?= $deflacao['valor_deflacao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>deflacao/edicao?id=<?= $deflacao['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>