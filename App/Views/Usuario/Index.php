<div class="d-flex justify-content-between mb-4">
    <h3 class="text-center"><i class="bi bi-person-gear"></i> Usuários</h3>
    <a class="btn btn-dark-blue" href="<?= URL ?>usuario/cadastro"><i class="bi bi-person-add"></i> Novo Usuário</a>
</div>

<div class="table-responsive mt-2">
    <table class="table table-hover" id="usuariosTable">
        <thead>
            <tr>
                <th class="text-center align-middle">Id filial</th>
                <th class="text-center align-middle">Filial</th>
                <th class="text-center align-middle">Usuario</th>
                <th class="text-center align-middle">Permissão</th>
                <th class="text-center align-middle">Editar</th>
                <th class="text-center align-middle">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->getViewVar()['usuarios'] as $usuario) { ?>
                <tr>
                    <td class="text-center align-middle"><?= $usuario['id_filial'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['filial'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['usuario'] ?></td>
                    <td class="text-center align-middle"><?= $usuario['tipo_permissao'] ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-warning" href="<?= URL ?>usuario/edicao?id=<?= $usuario['id'] ?>">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="<?= URL ?>usuario/deletar?id=<?= $usuario['id'] ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>