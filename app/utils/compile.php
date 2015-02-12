<?php

/*
 * script to create a compiled php classes using ClassPreLoader.
 */

use ClassPreloader\Command\PreCompileCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

$vendor_dir = dirname(dirname(__DIR__)).'/vendor';
require_once( $vendor_dir.'/autoload.php');


// location of class preLoader script.
$preLoader   = $vendor_dir.'/bin/classpreloader.php';
$getIncludes = __DIR__.'/compile-includes.php';
$outputPath  = dirname(dirname(__DIR__)).'/var/compiled.php';

$command = new PreCompileCommand();
$command->run( new ArrayInput(
    array(
        '--config' => $getIncludes,
        '--output' => $outputPath,
        '--strip_comments' => 1,
    )
), new NullOutput);