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
    <?php if($BolsaUser):?>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-8 col-md-offset-3 col-sm-offset-2 col-lg-offset-3">

            <h1 class="text-primary text-center">Remover registro - Bolsa Família</h1>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <?php foreach ($BT as $config):?>
                            <tr>
                                <td><strong><?= $config;?></strong></td>
                                <td><?= $BolsaUser->{"get".$config}();?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-xs-12">
                    <form action="bolsa-hash-delete.php" method="POST">
                        <input type="hidden" name="offset" value="<?= $offset;?>">
                        <input type="hidden" name="length" value="<?= $length;?>">

                        <button type="submit" class="btn btn-danger pull-right">
                            <i class="fa fa-times-circle fa-lg fa-fw"></i> REMOVER
                        </button>
                        <a role="button" href="bolsa-hash.php" class="btn btn-danger pull-left">
                            <i class="fa fa-arrow-left fa-lg fa-fw"></i> VOLTAR
                        </a>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                <h1 class="text-danger text-center">REGISTRO NÃO ENCONTRADO</h1>
                <hr>
                <a href="bolsa-hash.php" class="btn btn-danger pull-right">VOLTAR</a>
            </div>
        </div>
    <?php endif;?>
</div>
</body>
</html>