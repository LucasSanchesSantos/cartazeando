<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Novo produto</h3>

<form action="<?= URL ?>produtoCadastro/cadastrar" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Código do produto</label>
        <input type="text" class="form-control" id="id_produto" name="id_produto" placeholder="Digite o código do produto" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Cor</label>
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
        <label for="numeroFilial" class="form-label">Voltagem</label>
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
        <label for="numeroFilial" class="form-label">Produto</label>
        <input type="text" class="form-control" id="produto" name="produto" placeholder="Digite o nome do novo produto" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Preço venda</label>
        <input type="text" class="form-control moeda" id="preco_venda" name="preco_venda" placeholder="Digite o preço do novo produto" required>
    </div>
    <div class="mb-3">
        <p>
            <label for="" class="form-label">Selecione a imagem do produto</label>
            <input type="file" class="form-control" name="imagem" id="imagem" required>
        </p>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>