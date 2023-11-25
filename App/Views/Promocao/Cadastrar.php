<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Novo produto</h3>

<form action="<?= URL ?>promocao/cadastrar" method="post">
    <div class="mb-3">
        <label for="descricao" class="form-label">Nome da promoção</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome da promoção" required>
    </div>
    <div class="mb-3">
        <label for="id_produto" class="form-label">Código do produto</label>
        <select class="form-select" id="id_produto" name="id_produto" required>
            <?php
                    foreach ($this->viewVar['produtoCadastro'] as $produto) {
                ?>
                    <option value=<?= $produto['id_produto']?>>
                        <?= $produto['produto'] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
    <div class="mb-3">
        <label for="id_cor" class="form-label">Cor</label>
        <select class="form-select" id="id_cor" name="id_cor" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['cor'] as $cor) {
            ?>
                <option value=<?= $cor['id'] ?>>
                    <?= $cor['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_voltagem" class="form-label">Voltagem</label>
        <select class="form-select" id="id_voltagem" name="id_voltagem" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['voltagem'] as $idVoltagem) {
            ?>
                <option value=<?= $idVoltagem['id'] ?>>
                    <?= $idVoltagem['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_filial" class="form-label">Filial</label>
        <select class="form-select" id="id_filial" name="id_filial" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['filial'] as $filial) {
            ?>
                <option value=<?= $filial['id'] ?>>
                    <?= $filial['filial'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="valor_promocao" class="form-label">Preço venda</label>
        <input type="text" class="form-control moeda" id="valor_promocao" name="valor_promocao" placeholder="Digite o valor da promoção" required>
    </div>
    <div class="mb-3">
        <label for="data_inicio" class="form-label">Data início</label>
        <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
    </div>
    <div class="mb-3">
        <label for="data_fim" class="form-label">Data fim</label>
        <input type="date" class="form-control" id="data_fim" name="data_fim" required>
    </div>
    <div class="mb-3">
        <label for="id_tipo_pagamento" class="form-label">Tipo Promoção</label>
        <select class="form-select" id="id_tipo_pagamento" name="id_tipo_pagamento" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['tipoPagamento'] as $tipoPagamento) {
            ?>
                <option value=<?= $tipoPagamento['id'] ?>>
                    <?= $tipoPagamento['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Venda com entrada?</label>
        <select class="form-select" id="parcela_inicio" name="parcela_inicio" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['pagementoEntrada'] as $pagementoEntrada) {
            ?>
                <option value=<?= $pagementoEntrada['id_value'] ?>>
                    <?= $pagementoEntrada['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Quantidade de parcelas totais</label>
        <select class="form-select" id="parcela_fim" name="parcela_fim" required>
            <option value="">Selecione</option>
            <?php
                foreach ($this->viewVar['qtdParcela'] as $pagementoEntrada) {
            ?>
                <option value=<?= $pagementoEntrada['qtd_parcelas'] ?>>
                    <?= $pagementoEntrada['qtd_parcelas'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>