<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEP SEARCHER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <style type="text/css">
        .table-centered tbody tr td{
            text-align: center;
        }
        .table-centered thead tr th{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($address):?>
            <h1 class="text-success">Resultado para busca do CEP <?= $address->cep();?></h1>
            <hr>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h3 class="text-success">Informações</h3>
                    <hr>
                    <table class="table table-bordered table-hover table-centered">
                        <tbody>
                            <?php foreach (config("address_template") as $config => $size):?>
                                <?php if($config!="blank_space"):?>

                                    <tr>
                                        <td>
                                            <b><?= strtoupper($config);?></b>
                                        </td>
                                        <td>
                                            <?php printf("%.".$size."s",$address->$config());?>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h4 class="text-success">Array consults (<?= count($this->consults());?>)</h4>
                    <hr>
                    <table class="table table-bordered table-hover table-centered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>De</th>
                            <th>Até</th>
                            <th>Meio</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->consults() as $i => $consult):?>

                                    <tr>
                                        <td><b><?= ($i+1);?></b></td>
                                        <td>
                                            <?= $consult['min'];?>
                                        </td>
                                        <td>
                                            <?= $consult['max'];?>
                                        </td>
                                        <td>
                                            <?= $consult['middle'];?>
                                        </td>
                                    </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h1 class="text-danger">CEP NÃO ENCONTRADO</h1>
                    <hr>
                </div>
            </div>
        <?php endif;?>
    </div>
</body>
</html>