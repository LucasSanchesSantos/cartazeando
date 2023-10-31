<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Produto</h3>

<form action="<?= URL ?>promocao/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($promocao['id']) ?>>
    
        <div class="mb-3">
            <label class="form-label">Id Promoção</label>
            <input type="text" class="form-control" id="id" disabled="" name="id" value="<?= $this->viewVar['promocao']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descricao</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $this->viewVar['promocao']['descricao'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Código do produto</label>
            <select class="form-select" id="id_produto" name="id_produto" required>
            <?php
                    foreach ($this->viewVar['produtoCadastro'] as $produto) {
                ?>
                    <option value=<?= $produto['id_produto'] ?> <?= $this->viewVar['promocao']['id_produto'] == $produto['id_produto'] ? 'selected' : '' ?>>
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
            <?php
                    foreach ($this->viewVar['cor'] as $cor) {
                ?>
                    <option value=<?= $cor['id'] ?> <?= $this->viewVar['promocao']['id_cor'] == $cor['id'] ? 'selected' : '' ?>>
                        <?= $cor['descricao'] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Voltagem</label>
            <select class="form-select" id="id_voltagem" name="id_voltagem" required>
            <?php
                foreach ($this->viewVar['voltagem'] as $voltagem) {
            ?>
                <option value=<?= $voltagem['id'] ?> <?= $this->viewVar['promocao']['id_voltagem'] == $voltagem['id'] ? 'selected' : '' ?>>
                    <?= $voltagem['descricao'] ?>
                </option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Id filial</label>
            <select class="form-select" id="id_filial" name="id_filial" required>
            <?php
                foreach ($this->viewVar['filial'] as $filial) {
            ?>
                <option value=<?= $filial['id'] ?> <?= $this->viewVar['promocao']['id_filial'] == $filial['id'] ? 'selected' : '' ?>>
                    <?= $filial['filial'] ?>
                </option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço promoção</label>
            <input type="text" class="form-control" id="valor_promocao" name="valor_promocao" value="<?= $this->viewVar['promocao']['valor_promocao'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data início</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?= $this->viewVar['promocao']['data_inicio'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data fim</label>
            <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?= $this->viewVar['promocao']['data_fim'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo pagamento</label>
            <select class="form-select" id="id_tipo_pagamento" name="id_tipo_pagamento" required>
            <?php
                foreach ($this->viewVar['tipoPagamento'] as $tipoPagamento) {
            ?>
                <option value=<?= $tipoPagamento['id'] ?> <?= $this->viewVar['promocao']['id_tipo_pagamento'] == $tipoPagamento['id'] ? 'selected' : '' ?>>
                    <?= $tipoPagamento['descricao'] ?>
                </option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Parcela início</label>
            <input type="text" class="form-control" id="parcela_inicio" name="parcela_inicio" value="<?= $this->viewVar['promocao']['parcela_inicio'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parcela fim</label>
            <input type="text" class="form-control" id="parcela_fim" name="parcela_fim" value="<?= $this->viewVar['promocao']['parcela_fim'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Situação</label>
            <select class="form-select" id="id_situacao" name="id_situacao" required>
            <?php
                foreach ($this->viewVar['situacao'] as $situacao) {
            ?>
                <option value=<?= $situacao['id'] ?> <?= $this->viewVar['promocao']['id_situacao'] == $situacao['id'] ? 'selected' : '' ?>>
                    <?= $situacao['descricao'] ?>
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