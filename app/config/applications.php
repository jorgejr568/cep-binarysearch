<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 25/05/18
 * Time: 13:17
 */
return [
    "binary-search" => [
        "type" => "segment",
        "name" => "Busca binária",
        "projects" => [
            "cep" => [
                "file" => "cep.php",
                "name" => "Procura CEP",
                "description" => "O programa faz uma busca binária num arquivo de mais de 600 mil linhas contendo todos os CEPs existentes. Tendo seu resultado em menos de 18 consultas, quando normalmente levaria milhares"
            ],
        ]
    ],
    "prova-refractor" => [
        "type" => "segment",
        "name" => "Refazendo a P1",
        "projects" => [
            "prova-refractor-1" => [
                "file" => "prova-refractor-1.php",
                "name" => "Exercicio 1",
                "description" => "Seja prova-dummy.dat um arquivo de Registros ordenado por chaves em ordem crescente. Gerar um arquivo prova-dummy-reverse.dat em ordem decrescente. Não precisa (nem pode) usar a função de ordenação."
            ],
            "prova-refractor-2" => [
                "file" => "prova-refractor-2.php",
                "name" => "Exercicio 2",
                "description" => "Seja prova-dummy.dat um arquivo de Registros desordenado. Gerar um arquivo prova-dummy-website.dat com os registros cujo website termine com `uma extensão qualquer`. Use uma função terminaCom para fazer o processamento."
            ],
            "prova-refractor-3" => [
                "file" => "prova-refractor-3.php",
                "name" => "Exercicio 3",
                "description" => "Seja prova-dummy-desordered.dat um arquivo de registros desordenado e prova-dummy.dat um arquivo ordenado por chave. Gerar um arquivo prova-dummy-merge.dat com os registros que estejam ao mesmo tempo (mesma chave) em prova-dummy.dat e prova-dummy-desordered.dat. Os dois arquivos não tem chaves repetidas."
            ]
        ]

    ]
];