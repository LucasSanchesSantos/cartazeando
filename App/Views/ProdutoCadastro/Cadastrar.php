<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Novo produto</h3>

<form action="<?= URL ?>produtoCadastro/cadastrar" method="post">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Código do produto</label>
        <input type="text" class="form-control" id="id_produto" name="id_produto" placeholder="Digite o código do produto" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Cor</label>
        <input type="text" class="form-control" id="id_cor" name="id_cor" placeholder="" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Voltagem</label>
        <input type="text" class="form-control" id="id_voltagem" name="id_voltagem" placeholder="" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Produto</label>
        <input type="text" class="form-control" id="produto" name="produto" placeholder="Digite o nome do novo produto" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Preço venda</label>
        <input type="numeric" class="form-control" id="preco_venda" name="preco_venda" placeholder="Digite o preço do novo produto" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>