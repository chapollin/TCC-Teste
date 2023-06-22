<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php');
require_once('../bd/bd_promissoria.php');
require_once('../bd/bd_generico.php');

function formatarDinheiro($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// Verifica se o parâmetro 'cod' está definido na URL
if (!isset($_GET['cod'])) {
    echo 'Código do cliente não especificado.';
    exit();
}

$codCliente = $_GET['cod'];

// Obtém as promissórias do cliente
$promissorias = listaPromissoriaCliente($codCliente);
    $nomeCliente =$promissorias[0]['nome'];
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('../layout/navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detalhes das Promissórias de <?= $nomeCliente?></h1>

        <?php if (count($promissorias) > 0): ?>
        
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Descrição do Produto(s)</th>
                            <th>Valor</th>
                            <th>Data da compra</th>
                            <th>Data de vencimento</th>
                            <th>Atualizar</th>
                            <th>excluir</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach ($promissorias as $promissoria): ?>
                            <tr>
                                <td><?= $promissoria['descricao'] ?></td>
                                <td><?= formatarDinheiro($promissoria['valor']) ?></td>
                                <td><?= date('d/m/Y', strtotime($promissoria['data_compra'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($promissoria['data_vencimento'])) ?></td>
                                    <td class="text-center"> 
                                        <a title="Atualizar" href="../promissoria/editar_promissoria.php?cod=<?=$promissoria['cod']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit">&nbsp;</i>Atualizar</a>
                                    </td>
                                    <td class="text-center">
                                        <a title="Excluir" href="javascript:void(0)" data-toggle="modal" data-target="#excluir-<?=$promissoria['cod'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt">&nbsp;</i>Excluir</a>
                                    </td> 
                                    <div class="modal fade" id="excluir-<?=$promissoria['cod'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Excluir Promissoria</h5>
                                            </div>
                                            <div class="modal-body">Deseja realmente excluir esta informação?</div>
                                            <div class="modal-footer">
                                             <a href="remove_promissoria1.php?cod=<?=$promissoria['cod'];?>"><button class="btn btn-primary btn-user" type="button">Confirmar</button></a>
                                             <a href="ordem.php"><button class="btn btn-danger btn-user" type="button">Cancelar</button></a>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <div class="col-md-4 card_button_title">
                        <a title="Adicionar nova ordem" href="cad_promissoria1.php"><button type="button" class="btn btn-primary btn-sm card_button_title" data-toggle="modal" id=" "> <i class="fas fa-fw fa-clipboard-list">&nbsp;</i> Adicionar Promissória</button></a>

                    </div>                   
                </table>
            </div>            
        <?php else: ?>
        
            <p>Não há promissórias para exibir.</p>
        
        <?php endif; ?>

    </div>
    <!-- End of Main Content -->

    <?php require_once('../layout/footer.php'); ?>