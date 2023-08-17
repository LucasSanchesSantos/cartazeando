<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Tipo de pagamentos</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>tipoPagamento/cadastro"><i class="bi bi-person-add"></i> Novo Usuário</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="tipoPagamento">
        <thead>
            <tr>
                <th class="text-center align-middle">ID tipo pagamento</th>
                <th class="text-center align-middle">Tipo pagamento</th>
                <th class="text-center align-middle">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['tipoPagamento'] as $tipoPagamento) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $tipoPagamento['id'] ?></td>
                    <td class="text-center align-middle"><?= $tipoPagamento['descricao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>tipoPagamento/edicao?id=<?= $tipoPagamento['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>