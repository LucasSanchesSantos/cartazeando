<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-printer"></i> Personalizar impressão</h3>
</div>

<div class="table-responsive mt-2">
    <form id="impressaoPersonalizadaForm" method="post">
           <div class="mb-4">
                <label class="form-label">Filial</label>
                <select class="form-control selectpicker" name="idfilial" title="Selecione" data-live-search="true" required>
                <?php
                    foreach ($this->viewVar['filiais'] as $filiais) { ?>
                        <option value="<?= "{$filiais['id_filial']}"?>">
                            <?= strtoupper("{$filiais['filial']}")?>
                        </option>
                <?php
                    }
                ?>
                </select>
            </div>
    
        <div class="mb-4">
            <label class="form-label" for="idprodutoxy">Produto</label>
            <select class="form-control selectpicker" id="idprodutoxy" name="idprodutoxy" title="Selecione" data-live-search="true" required>
                <?php if($_POST){ ?>
                    <option value="<?= "{$_POST['idprodutoxy']}"?>">
                        <?= "{$_POST['idprodutoxy']}"?>
                    </option>
                <?php }?>
                <?php foreach ($this->viewVar['produtos'] as $produtos) { ?>
                <option value="<?= "{$produtos['id_produto']}.{$produtos['id_grade_x']}.{$produtos['id_grade_y']}"?>">
                    <?= strtoupper("{$produtos['id_produto']}.{$produtos['id_grade_x']}.{$produtos['id_grade_y']} - {$produtos['produto']}") ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label">Valor de</label>
            <input type="text" class="form-control moeda" name="valorDe" placeholder="R$">
        </div>
        <div class="mb-4">
            <label class="form-label">Valor atual</label>
            <input type="text" name="valorAtual" class="form-control moeda" placeholder="R$" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Venda com entrada?</label>
            <select class="form-control selectpicker" name="quantidadeParcelasEntrada" title="Selecione" required>
                <option value=0>Não</option>
                <option value=1>Sim</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Parcelas totais</label>
            <!-- <select class="form-control selectpicker" id="quantidadeParcelasTotal" name="quantidadeParcelasTotal" title="Selecione" data-live-search="true" required>
                <?php foreach ($this->viewVar['totalParcelas'] as $totalParcelas) { ?>
                    <option value="<?= "{$totalParcelas['parcela_ate']}"?>">
                        <?= strtoupper("{$totalParcelas['parcela_ate']}")?>
                    </option>
                <?php } ?>
            </select> -->
            <input type="text" name="quantidadeParcelasTotal" class="form-control moeda"required>

        </div>

        <div class="mb-4">
            <label class="form-label">Tipo promoção</label>
            <select class="form-control selectpicker" id="tipo" name="tipo" title="Selecione" required>
                <?php if($_POST){ ?>
                    <option value="<?= $_POST['tipo']?>">
                        <?= $_POST['tipo']?>
                    </option>
                <?php }?>
                <option value='À vista'>À vista</option>
                <option value='Cartão'>Cartão</option>
                <option value='Carteira'>Carteira</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Valido de</label>
            <input type="date" name="validoDe" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Valido até</label>
            <input type="date" name="validoAte" class="form-control" required>
        </div>

        <button type="button" class="btn btn-dark-blue" onclick="abrirModalCartaz()">
            Imprimir
        </button>
    </form>
</div>


<div class="modal fade" id="modalCartaz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark-blue text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Selecione o formato de cartaz</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <?php foreach ($this->viewVar['tiposCartazes'] as $tiposCartazes) { ?>
                        <div class="col-md-6">
                            <div class="card text-center mx-3 p-3" onclick="impressao('<?= $tiposCartazes['tipo_cartaz'] ?>')">
                                <div class="d-flex justify-content-center">
                                    <img src="<?= PATH_IMG ?>sticky.svg" class="imagem-centralizada" style="width: 50%;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= "{$tiposCartazes['tipo_cartaz']}"?></h5>
                                    <p class="card-text"><?= "{$tiposCartazes['dimensao_inicial']}cm x {$tiposCartazes['dimensao_final']}cm"?></p>
                                    <p class="card-text"><?= "{$tiposCartazes['qtd_folhas']}"?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>