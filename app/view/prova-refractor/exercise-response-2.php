<?php
use CEPSearcher\Exception\InvalidLineProvaDummy;
use CEPSearcher\Model\ProvaDummy;
?>
<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercicio 2 - Refazendo a prova</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h1 class="text-primary text-center">Refazendo a prova</h1>
    <hr>
    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12 col-md-offset-1 col-sm-offset-0 col-lg-offset-1">
            <h2 class="text-primary text-center">Exercicio 2 - Filtro <?= $endCheck;?></h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-bordered table-hover table-centered">
                        <thead>
                        <tr>
                            <?php
                            foreach ($dummy_template as $field => $size):?>
                                <?php if($field!="blank"):?>
                                    <td><?= ucfirst(strtolower($field))?></td>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var \CEPSearcher\Engine\File\File $dummy_dat */
                        $dummy_filtered->seek(0);
                        while (true):?>
                            <?php
                            $dummy_line = $dummy_filtered->r($dummy_size);
                            if($dummy_filtered->eof()) break;
                            /** @var ProvaDummy $Dummy */
                            try {
                                $Dummy = ProvaDummy::create_from_line($dummy_line);
                            } catch (InvalidLineProvaDummy $e) {
                                die($e->getMessage());
                            }
                            ?>
                            <tr>
                                <?php foreach ($dummy_template as $field => $size):?>
                                    <?php if($field!="blank"):?>
                                        <td><?= $Dummy->{"get".ucfirst(strtolower($field))}()?></td>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </tr>
                        <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="prova-refractor-2.php" class="btn btn-danger pull-right">VOLTAR</a>
        </div>
    </div>
</div>
</body>
</html>