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
            <div class="col-md-6 col-lg-6 col-sm-8 col-md-offset-3 col-sm-offset-2 col-lg-offset-3">
                <h2 class="text-primary text-center">Exercicio 2</h2>
                <hr>
                <form class="form-horizontal" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="extension" class="control-label">Selecione a extensão do website</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="extension" id="extension">
                                    <?php foreach($extensions as $extension):?>
                                        <option value="<?= $extension;?>"><?= $extension;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-filter fa-lg fa-fw"></i> FILTRAR
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>