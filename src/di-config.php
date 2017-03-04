<?php

use function DI\get;
use function DI\object;
use DrupalCampLdn\Domain\AddList;
use DrupalCampLdn\Domain\GetList;
use DrupalCampLdn\Domain\GetAllLists;
use DrupalCampLdn\TodoRepository;
use DrupalCampLdn\TodoRepositoryInterface;
use IdNet\StackRunner\StackRunner;
use IdNet\Wafer\Action;
use IdNet\Wafer\DefaultConfiguration;
use IdNet\Wafer\Middleware\ActionDomainResponder;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Middlewares\BasicAuthentication;
use Middlewares\JsonPayload;
use Middlewares\Utils\Factory\ResponseFactory;
use Middlewares\Utils\Factory\StreamFactory;

return [



//    1. BASIC SETUP


        'middleware' => [
            ActionDomainResponder::class
        ],

        'routes' => [
            ['GET',  '/', 'action.get-all-lists'],
        ],

        'action.get-all-lists' => object(Action::class)
            ->method('domain', GetAllLists::class),


        TodoRepositoryInterface::class => get(TodoRepository::class),





        // 2. Add parameter
//        'middleware' => [
//            ActionDomainResponder::class
//        ],
//
//        'routes' => [
//            ['GET',  '/',             'action.get-all-lists'],
//            ['GET',  '/list/{name}', 'action.get-list'],
//        ],
//
//        'action.get-all-lists' => object(Action::class)
//            ->method('domain', GetAllLists::class),
//
//        'action.get-list' => object(Action::class)
//            ->method('domain', GetList::class),
//
//





// 3. ADD JSON BODY
//
//        'middleware' => [
//            JsonPayload::class,
//            ActionDomainResponder::class
//        ],
//
//        'routes' => [
//            ['GET',  '/',             'action.get-all-lists'],
//            ['GET',  '/list/{name}', 'action.get-list'],
//            ['POST', '/list/{name}', 'action.add-list']
//        ],
//
//        'action.get-all-lists' => object(Action::class)
//            ->method('domain', GetAllLists::class),
//
//        'action.get-list' => object(Action::class)
//            ->method('domain', GetList::class),
//
//        'action.add-list' => object(Action::class)
//            ->method('domain', AddList::class),








// 4. ADD AUTHENTICATION
//
//    'middleware' => [
//        BasicAuthentication::class,
//        JsonPayload::class,
//        ActionDomainResponder::class
//    ],
//
//
//    'valid.users' => [
//        'darren' => 'abc123',
//        'bob' => 'p4ssw0rd',
//    ],
//
//    BasicAuthentication::class => object()
//        ->constructor(get('valid.users'))
//        ->method('attribute', 'username'),
//
//
//
//    'routes' => [
//        ['GET',  '/',             'action.get-all-lists'],
//        ['GET',  '/list/{name}', 'action.get-list'],
//        ['POST', '/list/{name}', 'action.add-list']
//    ],
//
//    'action.get-all-lists' => object(Action::class)
//        ->method('domain', GetAllLists::class),
//
//    'action.get-list' => object(Action::class)
//        ->method('domain', GetList::class),
//
//    'action.add-list' => object(Action::class)
//        ->method('domain', AddList::class),










    FilesystemInterface::class => object(Filesystem::class)
        ->constructor(get('fs.adapter')),
    'fs.adapter' => object(Local::class)
        ->constructor(__DIR__.'/../var/data'),

    StackRunner::class => object()
        ->constructorParameter('stack', get('middleware')),


    ResponseFactoryInterface::class => get(ResponseFactory::class),
    StreamFactoryInterface::class => get(StreamFactory::class),



] + DefaultConfiguration::getConfig();
