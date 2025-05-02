<?php


use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Tutorial;



//ROTA Tutorial
$obRouter->get('',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getTutorial($request));
    }
    ]);

//ROTA Tutorial Antes de Começar
$obRouter->get('/antesdecomecar',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getAntesdeComecar($request));
    }
    ]);

//ROTA Tutorial O que é SQL
$obRouter->get('/oqueesql',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getOqueeSql($request));
    }
    ]);

//ROTA Tutorial Introdução a Banco de Dados
$obRouter->get('/introducaoabancodedados',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getIntroducaoaBancodeDados($request));
    }
    ]);

//ROTA Tutorial Create Database
$obRouter->get('/createdatabase',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getCreateDatabase($request));
    }
    ]);

//ROTA Tutorial Show Databases
$obRouter->get('/showdatabases',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getShowDatabases($request));
    }
    ]);


//ROTA Tutorial USE Database
$obRouter->get('/usedatabase',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getUseDatabase($request));
    }
    ]);


//ROTA Tutorial Create Table
$obRouter->get('/createtable',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getCreateTable($request));
    }
    ]);


//ROTA Tutorial showtables
$obRouter->get('/showtables',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getShowTables($request));
    }
    ]);

//ROTA Tutorial showcolumns
$obRouter->get('/showcolumns',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getShowColumns($request));
    }
    ]);


//ROTA Tutorial Alter Table
$obRouter->get('/altertable',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getAlterTable($request));
    }
    ]);
//ROTA Tutorial restricoes
$obRouter->get('/restricoes',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getRestricoes($request));
    }
    ]);
//ROTA Tutorial Insert
$obRouter->get('/insert',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getInsert($request));
    }
    ]);
//ROTA Tutorial select
$obRouter->get('/select',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getSelect($request));
    }
    ]);

//ROTA Tutorial orderby
$obRouter->get('/orderby',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getOrderby($request));
    }
    ]);

//ROTA Tutorial update
$obRouter->get('/update',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getUpdate($request));
    }
    ]);
//ROTA Tutorial delete
$obRouter->get('/delete',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getDelete($request));
    }
    ]);

//ROTA Tutorial droptable
$obRouter->get('/droptable',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getDropTable($request));
    }
    ]);

//ROTA Tutorial Truncate Table
$obRouter->get('/truncatetable',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getTruncateTable($request));
    }
    ]);
//ROTA Tutorial dropdatabase
$obRouter->get('/dropdatabase',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getDropDatabase($request));
    }
    ]);

//ROTA Tutorial join
$obRouter->get('/join',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getJoin($request));
    }
    ]);
//ROTA Tutorial innerjoin
$obRouter->get('/innerjoin',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getInnerJoin($request));
    }
    ]);

//ROTA Tutorial leftjoin
$obRouter->get('/leftjoin',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getLeftJoin($request));
    }
    ]);

//ROTA Tutorial rightjoin
$obRouter->get('/rightjoin',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getRightJoin($request));
    }
    ]);

//ROTA Tutorial union
$obRouter->get('/union',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getUnion($request));
    }
    ]);

//ROTA Tutorial referencias
$obRouter->get('/referencias',[
    function ($request){
        return new Response(200, Tutorial\Tutorial::getReferencias($request));
    }
    ]);


