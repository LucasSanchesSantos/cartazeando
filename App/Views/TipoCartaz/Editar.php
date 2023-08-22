<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Usuário</h3>

<form action="<?= URL ?>tipoCartaz/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($tipoCartaz['id']) ?>>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $this->viewVar['tipoCartaz']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de cartaz</label>
            <input type="numeric" class="form-control" id="descricao" name="descricao" value="<?= $this->viewVar['tipoCartaz']['descricao'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tamanho inicial</label>
            <input type="numeric" class="form-control" id="dimensaoInicial" name="dimensaoInicial" value="<?= $this->viewVar['tipoCartaz']['dimensao_inicial'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tamanho final</label>
            <input type="numeric" class="form-control" id="dimensaoFinal" name="dimensaoFinal" value="<?= $this->viewVar['tipoCartaz']['dimensao_final'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade de folhas</label>
            <input type="numeric" class="form-control" id="qtdFolhas" name="qtdFolhas" value="<?= $this->viewVar['tipoCartaz']['qtd_folhas'] ?>" required>
        </div>  
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>