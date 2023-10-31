<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Produto</h3>

<form action="<?= URL ?>produtoCadastro/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($produtoCadastro['id']) ?>>
    
        <div class="mb-3">
            <label class="form-label">Código do produto</label>
            <input type="text" class="form-control" id="id_produto" name="id_produto" value="<?= $this->viewVar['produtoCadastro']['id_produto'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cor</label>
            <select class="form-select" id="id_cor" name="id_cor" required>
            <?php
                    foreach ($this->viewVar['cor'] as $cor) {
                ?>
                    <option value=<?= $cor['id'] ?> <?= $this->viewVar['produtoCadastro']['id_cor'] == $cor['id'] ? 'selected' : '' ?>>
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
                <option value=<?= $voltagem['id'] ?> <?= $this->viewVar['produtoCadastro']['id_voltagem'] == $voltagem['id'] ? 'selected' : '' ?>>
                    <?= $voltagem['descricao'] ?>
                </option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Produto</label>
            <input type="text" class="form-control" id="produto" name="produto" value="<?= $this->viewVar['produtoCadastro']['produto'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço venda</label>
            <input type="text" class="form-control" id="preco_venda" name="preco_venda" value="<?= $this->viewVar['produtoCadastro']['preco_venda'] ?>" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>