<?php


use \App\Http\Response;
use \App\Controller\Tutorial;


//ROTA Tutorial
$obRouter->get('/tutorial',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getTutorial($request));
    }
    ]);

//ROTA Tutorial Antes de Começar
$obRouter->get('/tutorial/antesdecomecar',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getAntesdeComecar($request));
    }
    ]);

//ROTA Tutorial O que é SQL
$obRouter->get('/tutorial/oqueesql',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getOqueeSql($request));
    }
    ]);

//ROTA Tutorial Introdução a Banco de Dados
$obRouter->get('/tutorial/introducaoabancodedados',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getIntroducaoaBancodeDados($request));
    }
    ]);

//ROTA Tutorial Create Database
$obRouter->get('/tutorial/createdatabase',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getCreateDatabase($request));
    }
    ]);