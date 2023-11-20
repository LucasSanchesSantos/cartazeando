<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Registros de impressões</h3>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="impressoesTable">
        <thead>
            <tr>
                <th class="text-center align-middle">Promoção</th>
                <th class="text-center align-middle">Filial</th>
                <th class="text-center align-middle">Código Prod.</th>
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Tipo pagamento</th>
                <th class="text-center align-middle">Valor Promoção</th>
                <th class="text-center align-middle">Data impressão</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['impressoes'] as $impressoes) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $impressoes['promocao'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['filial'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['id_produto'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['produto'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['tipo_pagamento'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['valor_promocao'] ?></td>
                    <td class="text-center align-middle"><?= date('d/m/Y', strtotime($impressoes['data_impressao'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>