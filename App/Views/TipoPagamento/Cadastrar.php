<h3 class="text-center mb-4"><i class="bi bi-gear-fill me-2"></i> Novo tipo pagamento</h3>

<form action="<?= URL ?>tipoPagamento/cadastrar" method="post">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Novo tipo de pagamento</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome do novo tipo de pagamento" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>