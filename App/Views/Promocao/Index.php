<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Promoções</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>promocao/cadastro"><i class="bi bi-person-add"></i> Nova promoção</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="promocaoTable">
        <thead>
            <tr>
                <th class="text-center align-middle">Id promoção</th>
                <th class="text-center align-middle">Descrição</th>
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Cor</th>
                <th class="text-center align-middle">Voltagem</th>
                <th class="text-center align-middle">Filial</th>
                <th class="text-center align-middle">Valor Promoção</th>
                <th class="text-center align-middle">Data início</th>
                <th class="text-center align-middle">Data fim</th>
                <th class="text-center align-middle">Tipo promoção</th>
                <th class="text-center align-middle">Venda com entrada?</th>
                <th class="text-center align-middle">Parcelas totais</th>
                <th class="text-center align-middle">Situacão</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['promocao'] as $promocao) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $promocao['id'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['descricao'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['produto'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['cor'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['voltagem'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['filial'] ?></td>
                    <td class="text-center align-middle">R$ <?= number_format($promocao['valor_promocao'], 2, ',', '.')?></td>
                    <td class="text-center align-middle"><?= date('d/m/Y', strtotime($promocao['data_inicio'])) ?></td>
                    <td class="text-center align-middle"><?= date('d/m/Y', strtotime($promocao['data_fim'])) ?></td>
                    <td class="text-center align-middle"><?= $promocao['tipo_pagamento'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['entrada'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['parcela_fim'] ?></td>
                    <td class="text-center align-middle"><?= $promocao['situacao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>promocao/edicao?id=<?= $promocao['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger delete-button" href="<?= URL ?>promocao/deletar?id=<?= $promocao['id'] ?>">
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

