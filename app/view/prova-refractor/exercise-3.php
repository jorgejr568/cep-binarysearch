<?php use CEPSearcher\Model\ProvaDummy;?>

<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercicio 3 - Refazendo a prova</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h1 class="text-primary text-center">Refazendo a prova</h1>
        <hr>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-sm-offset-0">
                <h2 class="text-primary text-center">Exercicio 3</h2>
                <hr>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="text-danger text-center toggle-table">Arquivo ordenado</h3>
                        <hr>
                        <div class="row table-row">
                            <div class="col-xs-12 table-responsive">
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
                                    $file_ordered->seek(0);
                                    while (true):?>
                                        <?php
                                        $dummy_line = $file_ordered->r($dummy_size);
                                        if($file_ordered->eof()) break;
                                        /** @var ProvaDummy $Dummy */
                                        try {
                                            $Dummy = ProvaDummy::create_from_line($dummy_line);
                                        } catch (\CEPSearcher\Exception\InvalidLineProvaDummy $e) {
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="text-danger text-center toggle-table">Arquivo desordenado</h3>
                        <hr>
                        <div class="row table-row">
                            <div class="col-xs-12 table-responsive">
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
                                    $file_disordered->seek(0);
                                    while (true):
                                        $dummy_line = $file_disordered->r($dummy_size);
                                        if($file_disordered->eof()) break;
                                        /** @var ProvaDummy $Dummy */
                                        try {
                                            $Dummy = ProvaDummy::create_from_line($dummy_line);
                                        } catch (\CEPSearcher\Exception\InvalidLineProvaDummy $e) {
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="text-success text-center toggle-table">Arquivo resultante</h3>
                        <hr>
                        <div class="row table-row" data-merged>
                            <div class="col-xs-12 table-responsive">
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
                                    $file_merged->seek(0);
                                    while (true):
                                        $dummy_line = $file_merged->r($dummy_size);
                                        if($file_merged->eof()) break;
                                        /** @var ProvaDummy $Dummy */
                                        try {
                                            $Dummy = ProvaDummy::create_from_line($dummy_line);
                                        } catch (\CEPSearcher\Exception\InvalidLineProvaDummy $e) {
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
    ></script>
    <script type="text/javascript">
        $('.table-row:not([data-merged])').css({display: "none"});
        $('.toggle-table').each(function(){
            $(this)
                .css({cursor: "pointer",backgroundColor: $(this).hasClass('text-success')?"#5cb85c":"#d9534f",color: "white",padding: "5px",fontWeight: "500"})
                .click(function(){
                    $(this).parent().find(".table-row").slideToggle("slow");
                });
        });
    </script>
</body>
</html>