<?php use CEPSearcher\Model\ProvaDummy;?>

<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercicio 1 - Refazendo a prova</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-center">Refazendo a prova</h1>
        <hr>
        <div class="row">
            <div class="col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2 col-sm-12 col-sm-offset-0">
                <h2 class="text-primary text-center">Exercicio 1</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-danger text-center">Arquivo principal</h3>
                        <hr>
                        <table class="table table-bordered table-hover table-centered">
                            <thead>
                                <tr>
                                    <?php foreach ($dummy_template as $field => $size):?>
                                        <?php if($field!="blank"):?>
                                            <td><?= ucfirst(strtolower($field))?></td>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            /** @var \CEPSearcher\Engine\File\File $dummy_dat */
                            $dummy_dat->seek(0);
                            while (true):?>
                                <?php
                                    $dummy_line = $dummy_dat->r($dummy_line_size);
                                    if($dummy_dat->eof()) break;
                                    /** @var ProvaDummy $Dummy */
                                    try {
                                        $Dummy = ProvaDummy::create_from_line($dummy_line);
                                    } catch (\CEPSearcher\Exception\InvalidLineProvaDummy $e) {
                                        die("ERROR - Dummy data line invalid size");
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

                    <div class="col-md-6">
                        <h3 class="text-success text-center">Arquivo revertido</h3>
                        <hr>
                        <table class="table table-bordered table-hover table-centered">
                            <thead>
                            <tr>
                                <?php foreach ($dummy_template as $field => $size):?>
                                    <?php if($field!="blank"):?>
                                        <td><?= ucfirst(strtolower($field))?></td>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dummy_reverse->seek(0);
                            while (true):?>
                                <?php
                                    $dummy_line = $dummy_reverse->r($dummy_line_size);
                                    if($dummy_reverse->eof()) break;
                                    /** @var ProvaDummy $Dummy */
                                    try {
                                        $Dummy = ProvaDummy::create_from_line($dummy_line);
                                    } catch (\CEPSearcher\Exception\InvalidLineProvaDummy $e) {
                                        die("ERROR - Dummy data line invalid size");
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

            </div>
        </div>
    </div>
</body>
</html>