<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Novo produto</h3>

<form action="<?= URL ?>promocao/cadastrar" method="post">
    <div class="mb-3">
        <label for="descricao" class="form-label">Nome da promoção</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome da promoção" required>
    </div>
    <div class="mb-3">
        <label for="id_produto" class="form-label">Código do produto</label>
        <input type="text" class="form-control" id="id_produto" name="id_produto" placeholder="" required>
    </div>
    <div class="mb-3">
        <label for="id_cor" class="form-label">Cor</label>
        <input type="text" class="form-control" id="id_cor" name="id_cor" placeholder="" required>
    </div>
    <div class="mb-3">
        <label for="id_voltagem" class="form-label">Voltagem</label>
        <input type="text" class="form-control" id="id_voltagem" name="id_voltagem" required>
    </div>
    <div class="mb-3">
        <label for="id_filial" class="form-label">Filial</label>
        <input type="text" class="form-control" id="id_filial" name="id_filial" required>
    </div>

    <div class="mb-3">
        <label for="valor_promocao" class="form-label">Preço venda</label>
        <input type="text" class="form-control" id="valor_promocao" name="valor_promocao" placeholder="Digite o valor da promoção" required>
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
        <label for="id_tipo_promocao" class="form-label">Tipo Promoção</label>
        <input type="text" class="form-control" id="id_tipo_promocao" name="id_tipo_promocao" required>
    </div>
    <div class="mb-3">
        <label for="parcela_inicio" class="form-label">Parcela início</label>
        <input type="text" class="form-control" id="parcela_inicio" name="parcela_inicio" required>
    </div>
    <div class="mb-3">
        <label for="parcela_fim" class="form-label">Parcela fim</label>
        <input type="text" class="form-control" id="parcela_fim" name="parcela_fim" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>