<?php

namespace core;

use app\exceptions\ControllerNaoEncontradaException;
use app\exceptions\ServiceNaoEncontradaException;
use app\exceptions\DAONaoEncontradaException;
use core\Controller;
use app\services\Service;
use app\dao\DAO;
use app\views\View;

abstract class ClassFactory {

    const CAMINHO_CONTROLLER = 'app\\controllers\\';
    const CAMINHO_SERVICE = 'app\\services\\';
    const CAMINHO_DAO = 'app\\dao\\';
    const CAMINHO_VIEW = 'app\\views\\';

    /**
     * Método responsável por fabricar intâncias de controllers.
     *
     * @param string $nomeController
     * @throws ControllerNaoEncontradaException
     * @return Controller
     */
    public static function makeController( string $nomeController ){
        $controller = self::CAMINHO_CONTROLLER . $nomeController . 'Controller';
        if( ! class_exists( $controller ) ){
            throw new ControllerNaoEncontradaException( "Controller $nomeController não existe", 404 );
        }

        return new $controller();
    }

    /**
     * Método responsável por fabricar intâncias de services.
     *
     * @param string $nomeService
     * @return Service
     */
    public static function makeService( string $nomeService ){
        $service = self::CAMINHO_SERVICE . $nomeService . 'Service';
        if( ! class_exists( $service ) ){
            throw new ServiceNaoEncontradaException( "Service $nomeService não existe", 404 );
        }

        return new $service();
    }

    /**
     * Método responsável por fabricar intâncias de DAOs.
     *
     * @param string $nomeDAO
     * @return DAO
     */
    public static function makeDAO( string $nomeDAO ){
        $DAO = self::CAMINHO_DAO . $nomeDAO . 'DAO';
        if( ! class_exists( $DAO ) ){
            throw new DAONaoEncontradaException( "DAO $nomeDAO não existe", 404 );
        }

        return new $DAO();
    }

    /**
     * Método responsável por fabricar intâncias de Views.
     *
     * @param string $nomeView
     * @return View
     */
    public static function makeView( string $nomeView ){
        $view = self::CAMINHO_VIEW . $nomeView . 'ViewEmTwig';
        if( ! class_exists( $view ) ){
            throw new DAONaoEncontradaException( "View $nomeView não existe", 404 );
        }

        return new $view();
    }
}