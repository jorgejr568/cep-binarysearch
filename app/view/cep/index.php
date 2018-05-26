<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEP SEARCHER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h1 class="text-primary text-center">Buscar CEP</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-8 col-md-offset-3 col-sm-offset-2 col-lg-offset-3">
            <form class="form-horizontal" method="POST">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="extension" class="control-label">Informe o CEP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cep" id="cep" maxlength="9" required minlength="8">
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