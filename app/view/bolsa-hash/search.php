<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bolsa família - CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <?php
        if(count($BolsaUsers)>0):?>
            <h1 class="text-success">Resultado para busca</h1>
            <h2 style="font-size: 16px;margin-top: -5px"><?= $Field;?>=<?= $Search;?>(<?= $SearchCrypted;?>)</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-success">Informações</h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-centered">
                            <thead>
                            <tr>
                                <th></th>
                                <?php foreach ($BT as $field):?>
                                    <th><?= $field;?></th>
                                <?php endforeach;?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($BolsaUsers as $bolsa_data):?>
                                    <tr>
                                        <td>
                                            <a href="bolsa-hash-delete.php?<?= http_build_query([
                                                    "offset" => trim($bolsa_data['hash']->getOffset()),
                                                    "length" => trim($bolsa_data['hash']->getSize())]);?>"
                                               class="text-danger">
                                                <i class="fa fa-fw fa-times-circle"></i>
                                            </a>
                                            <a href="bolsa-hash-update.php?<?= http_build_query([
                                                    "offset" => trim($bolsa_data['hash']->getOffset()),
                                                    "length" => trim($bolsa_data['hash']->getSize())]);?>"
                                               class="text-warning">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                        <?php foreach ($BT as $field):?>
                                            <td><?= $bolsa_data['user']->{"get".$field}();?></td>
                                        <?php endforeach;?>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h1 class="text-danger">NENHUM RESULTADO ENCONTRADO</h1>
                    <hr>
                </div>
            </div>
        <?php endif;?>
        <a href="bolsa-hash.php" class="btn btn-danger pull-right">VOLTAR</a>
    </div>
</body>
</html>