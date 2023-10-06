<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Usuário</h3>

<form action="<?= URL ?>voltagem/cadastrar" method="post">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Voltagem</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome da nova voltagem" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>