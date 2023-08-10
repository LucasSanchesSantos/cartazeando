<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Usuários</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>usuario/cadastro"><i class="bi bi-person-add"></i> Novo Usuário</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="usuariosTable">
        <thead>
            <tr>
                <th class="text-center align-middle">ID Filial</th>
                <th class="text-center align-middle">Número da Filial</th>
                <th class="text-center align-middle">Empresa</th>
                <th class="text-center align-middle">Cidade</th>
                <th class="text-center align-middle">Usuario</th>
                <th class="text-center align-middle">Formato</th>
                <th class="text-center align-middle">Permissão</th>
                <th class="text-center align-middle">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['usuarios'] as $usuario) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $usuario['id_filial'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['numero_filial'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['id_empresa'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['cidade'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['usuario'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['tipo_formato'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['tipo_permissao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>usuario/edicao?id=<?= $usuario['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>