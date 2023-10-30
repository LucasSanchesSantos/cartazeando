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
        <!-- <div class="mb-3">
            <label class="form-label">data_cadastro</label>
            <input type="text" class="form-control" id="data_cadastro" disabled="" name="data_cadastro" value="<?= $this->viewVar['promocao']['data_cadastro'] ?>" required>
        </div> -->
        <div class="mb-3">
            <label class="form-label">Código do produto</label>
            <input type="text" class="form-control" id="id_produto" name="id_produto" value="<?= $this->viewVar['promocao']['id_produto'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cor</label>
            <input type="text" class="form-control" id="id_cor" name="id_cor" value="<?= $this->viewVar['promocao']['id_cor'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Voltagem</label>
            <input type="text" class="form-control" id="id_voltagem" name="id_voltagem" value="<?= $this->viewVar['promocao']['id_voltagem'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Id filial</label>
            <input type="text" class="form-control" id="id_filial" name="id_filial" value="<?= $this->viewVar['promocao']['id_filial'] ?>" required>
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
            <label class="form-label">Tipo promoção</label>
            <input type="text" class="form-control" id="id_tipo_promocao" name="id_tipo_promocao" value="<?= $this->viewVar['promocao']['id_tipo_promocao'] ?>" required>
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
            <input type="text" class="form-control" id="id_situacao" name="id_situacao" value="<?= $this->viewVar['promocao']['id_situacao'] ?>" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>