<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i>Manutenção de deflação</h3>

<form action="<?= URL ?>deflacao/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : 0 ?>>

    <div class="mb-3">
        <label for="id_tipo_pagamento" class="form-label">Tipo pagametno</label>
        <select class="form-select" id="id_tipo_pagamento" name="id_tipo_pagamento" required>
            <?php
                foreach ($this->viewVar['tiposPagamento'] as $tiposPagamento) {
            ?>
                <option value=<?= $tiposPagamento['id'] ?> <?= $this->viewVar['deflacao']['id_tipo_pagamento'] == $tiposPagamento['id'] ? 'selected' : '' ?>>
                    <?= $tiposPagamento['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="parcela_de" class="form-label">Parcela início</label>
        <input type="number" class="form-control" id="parcela_de" name="parcela_de" value="<?= $this->viewVar['deflacao']['parcela_de'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="parcela_ate" class="form-label">Parcela fim</label>
        <input type="number" class="form-control" id="parcela_ate" name="parcela_ate" value="<?= $this->viewVar['deflacao']['parcela_ate'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="valor_deflacao" class="form-label">Valor deflação</label>
        <input type="text" class="form-control" id="valor_deflacao" name="valor_deflacao" value="<?= $this->viewVar['deflacao']['valor_deflacao'] ?>" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>