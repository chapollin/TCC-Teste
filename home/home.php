<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php');
require_once ('../bd/bd_generico.php');
require_once ('../bd/bd_usuario.php');
require_once ('../bd/bd_promissoria.php'); // Inclua o arquivo bd_promissoria.php

// Obtenha a lista de promissórias não pagas
$promissoriasNaoPagas = listaPromissoriaNaoPagas();
$promissoriasPagas =  listaPromissoriaPagas();
$promissoriasVencidas = listaPromissoriaVencidas();

?>

<!-- Main Content -->
<div id="content">
 <?php require_once('../layout/navbar.php');?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Promissórias Não Pagas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="../promissoria/promissorias_nao_pagas.php">
                                <?php echo count($promissoriasNaoPagas); ?></a>
                        </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Promissórias Vencidas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="../promissoria/promissorias_vencidas.php">
                                <?php echo count($promissoriasVencidas); ?></a>
                        </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Promissórias Pagas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="../promissoria/promissorias_pagas.php">
                                <?php echo count($promissoriasPagas); ?></a>
                        </div>
                    </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</div>
<!-- /.container-fluid -->

</div>


<?php
require_once('../layout/footer.php');
?>