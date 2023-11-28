<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-printer"></i> Quantidade de impressões por filial</h3>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="impressoesTable">
        <thead>
            <tr>
                <th class="text-center align-middle">Filial</th>
                <th class="text-center align-middle">Quantidade de impressões</th>
                <th class="text-center align-middle">Data impressão</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['impressoes'] as $impressoes) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $impressoes['filial'] ?></td>
                    <td class="text-center align-middle"><?= $impressoes['quantidade_impressoes'] ?></td>
                    <td class="text-center align-middle"><?= date('d/m/Y', strtotime($impressoes['data_impressao'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>