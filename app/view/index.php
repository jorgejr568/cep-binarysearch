<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Organização de estruturas de arquivos | Jorge Junior</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js" defer></script>
    <style type="text/css">
        .card-root{
            margin-top: 40px;
        }
        .card .card-content h1.card-title{
            margin-top: 0 ;
            margin-bottom: 60px;
            text-align: center;
            font-size: 40px;
        }
        .card h2.card-title{
            margin-top:0;
            margin-bottom: 40px;
        }
        .card h3.card-title{
            margin-top:0;
            margin-bottom: 30px !important;
            text-align: center;
            font-size: 20px;
            padding-bottom: 5px;
            border-bottom: 1px solid white;
        }
        .card p{
            font-size: 13px;
        }
        
        .card-project{
            -webkit-transition: 0.8s;
            -moz-transition: 0.8s ;
            -ms-transition: 0.8s ;
            -o-transition: 0.8s ;
            transition: 0.8s ;
            min-height: 260px;
        }
        .card-project:hover{
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -ms-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
            z-index: 50;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper grey darken-3">
            <a href="#" class="brand-logo center">Organização de estruturas de arquivos</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a target="_blank" href="https://github.com/jorgejr568/cep-binarysearch">GitHub</a></li>
                <li><a target="_blank" href="https://github.com/jorgejr568">Jorge Junior</a></li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col s10 offset-s1 m10 offset-m1">
            <div class="card card-root">
                <div class="card-content">
                    <h1 class="card-title">Projetos</h1>
                    <?php foreach ($applications as $application):?>
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h2 class="card-title"><?= $application['name'];?></h2>

                                        <div class="row">
                                            <?php foreach ($application['projects'] as $project):?>
                                                <div class="col s4">
                                                    <a target="_blank" href="<?= $project['file'];?>">
                                                        <div class="card card-project grey darken-2 white-text">
                                                            <div class="card-content">
                                                                <h3 class="card-title"><?= $project['name'];?></h3>

                                                                <p><?= $project['description'];?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>