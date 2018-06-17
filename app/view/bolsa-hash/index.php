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
    <h1 class="text-primary text-center">Bolsa Família - CRUD</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-8 col-md-offset-3 col-sm-offset-2 col-lg-offset-3">
            <form class="form-horizontal" method="POST">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="field" class="control-label">Campo pesquisado</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="field" id="field" required>
                                <?php foreach ($BT as $field):?>
                                    <option value="<?= $field;?>" <?= $field=="NISFavorecido"?"selected":"";?>><?= $field;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="value" class="control-label">Valor a pesquisar</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="value" id="value" required>

                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px">
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fa fa-search fa-lg fa-fw"></i> BUSCAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>