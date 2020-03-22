<?php
ini_set('display_errors',0);
/** @var \CEPSearcher\App $app */
$app=require_once __DIR__."/app/app.php";

/*
 * Starting CEP Searcher application
 */
$app->cepExercise(true);