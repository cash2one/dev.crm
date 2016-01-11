<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '名医主刀',
    // preloading 'log' component
    'preload' => array('log'),
    // 'defaultController' => 'site',
    // application default language.
    'language' => 'zh_cn',
    //'language'=>'en_us',
    // config to be defined at runtime.
    'behaviors' => array('ApplicationConfigBehavior'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.models.base.*',
        'application.models.core.*',
        'application.models.region.*',
        'application.models.site.*',
        'application.models.user.*',
        'application.models.auth.*',
        'application.models.email.*',
        'application.models.faculty.*',
        'application.models.doctor.*',
        'application.models.expertteam.*',
        'application.models.medicalrecord.*',
        'application.models.hospital.*',
        'application.models.event.*',
        'application.models.booking.*',
        'application.models.payment.*',
        'application.models.app.*',
        'application.models.template.*',
        'application.models.disease.*',
        'application.models.patient.*',
        'application.models.sales.*',
        'application.models.messagequeue.*',
        //'application.sdk.alipaydirect.*',
        'ext.mail.YiiMailMessage',
        'application.extensions.EValidators.*',
        'application.modules.translate.TranslateModule',
        'application.extensions.yiidebugtb.*',
        'application.apiservices.*',
        'application.imodels.*',
    ),
    'modules' => array(
        'mobiledoctor',
        'mobile',
        'translate', //manages translation message.
        'admin', //admin module.
        /** user module * */
        /*   'user' => array(
          'tableUsers' => 'tbl_users',
          'tableProfiles' => 'tbl_profiles',
          'tableProfileFields' => 'tbl_profiles_fields',
          ),
         * 
         */
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
        //Translation messages stored in db table.
        'messages' => array(
            'class' => 'CDbMessageSource',
            'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
            'sourceMessageTable' => 'translate_source_message',
            'translatedMessageTable' => 'translate_message',
            'language' => 'zh_cn',
        ),
        //Manages translation messages.
        'translate' => array(//if you name your component something else change TranslateModule
            'class' => 'translate.components.MPTranslate',
            //any avaliable options here
            'acceptedLanguages' => array(
                'zh_cn' => '中文',
                'en' => 'English',
            ),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
        ),
        'mail' => array(
            'class' => 'ext.mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.ym.163.com',
                'username' => 'noreply@mingyihz.com',
                'password' => '91466636',
                'port' => '994',
                'encryption' => 'ssl',
            // 'encryption' => 'tls',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'EWebUser',
            'loginUrl' => array('/user/login'),
        ),
        // User module
        /*
          'authManager' => array(
          'class' => 'CDbAuthManager',
          'connectionID' => 'db',
          'defaultRoles' => array('Authenticated', 'Guest'),
          ),
         * 
         */
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'caseSensitive' => false,
            'showScriptName' => false,
            'rules' => array(
                // api url.
                //array('api/payment', 'pattern'=>'api/<action:\w+>', 'verb'=>'POST'),
                //array('api/', 'pattern'=>'api/payment/doPay', 'verb'=>'POST'),
                // array('api/returnPay', 'pattern'=>'api/<type:\w+>', 'verb'=>'GET'),
                array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                //   array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                //'http://api.mingyihz.com/<action:(contactus)>' => 'mobile/app/<action>',
                'http://api.mingyihz.com/<action:\w+>' => 'mobile/<action>',
                'http://api.mingyihz.com' => 'mobile',
                //'<action:(contactus)>' => 'site/<action>',
                // mobile module url rewrite.
                'http://m.mingyihz.com/<action:(contactus)>' => 'mobile/app/enquiry',
                'http://m.mingyihz.com/<controller:\w+>' => 'mobile/<controller>',
                'http://m.mingyihz.com' => 'mobile',
                '<action:(contactus|enquiry)>' => 'site/<action>',
                //Temp, to be removed
                //   'overseas/elizabeth' => 'overseas/view',
                //   'hospital/tiantanpuhua' => 'hospital/view',
                'event/view/<page:\w+>' => 'event/view',
                '<view:(aboutus|faq|terms|media|rules|joinus|news|bigevents|zhitongche|refundAgreement)>' => 'site/page',
                '<controller:(huizhen|marketing)>/<id:\w+>' => '<controller>/view',
                '<controller:\w+>/<action:index>' => '<controller>/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            //  array('rest/list', 'pattern'=>'rest/item', 'verb'=>'GET'),
            ),
        ),
        
        /*
        // 数据库 staging
        'db' => array(
          'connectionString' => 'mysql:host=qpmyzdstaging91466636.mysql.rds.aliyuncs.com;dbname=myzd-staging',
          'emulatePrepare' => true,
          'username' => 'superstagereader',
          'password' => 'reader91466636',
          'charset' => 'utf8',
          'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        
        
        // 数据库 test
        'db' => array(
          'connectionString' => 'mysql:host=qpmyzdstaging91466636.mysql.rds.aliyuncs.com;dbname=myzd-test',
          'emulatePrepare' => true,
          'username' => 'supertestuser',
          'password' => 'Qp91466636',
          'charset' => 'utf8',
          'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        */ 
        
        // 数据库 local
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=myzd-local-1201',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        
        
        /*
        // 数据库 crm
        'db_crm' => array(
            'connectionString' => 'mysql:host=112.124.71.216;dbname=chenkuserdb1',
            'emulatePrepare' => true,
            'username' => 'jk',
            'password' => '123',
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        */
        
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'logTableName' => 'core_log',
                    'levels' => 'info,error'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'application.log',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'trace.log',
                    'levels' => 'trace',
                ),
                array(// configuration for the toolbar (yiidebugtb extension)
                    'class' => 'XWebDebugRouter',
                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
                    'levels' => 'error, warning, trace, profile, info',
                    'allowedIPs' => array('127.0.0.1', '::1', '192.168.1.54', '192\.168\.1[0-5]\.[0-9]{3}'),
                ),
            /*
              array(
              // log db command in firebug.
              'class' => 'CWebLogRoute',
              'categories' => 'system.db.CDbCommand',
              'showInFireBug' => true,
              'ignoreAjaxInFireBug' => false,
              ),
             * 
             */
            ),
        ),
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'core_session',
            'timeout' => 3600 * 24 * 14, // 14 days.
        ),
        'clientScript' => array(
            'class' => 'CClientScript',
            'coreScriptPosition' => CClientScript::POS_HEAD,
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'admin' => 'superbeta',
        'adminPassword' => '9be4e9c1e40a1952d3ad23cdb9343cedce6814d8e2b031d9d775ba58a02108b0', //qp91466636
        'adminEmail' => 'fainqin@foxmail.com',
        'contactEmail' => 'fainqin@foxmail.com', //used by contactus and enquiry.
        // 'registerBaiduScript' => true,
        //'registerCNZZScript'=>true,
        'medicalRecordFilePath' => 'upload/mr',
        'bookingFilePath' => 'upload/booking',
        "doctorFilePath" => "upload/doctor",   
        'doctorAvatar' => 'resource/doctor/avatar',
        'baseUrl' => 'http://mingyizhudao.com',
        'baseUrlMobile' => 'http://m.mingyihz.com',
        'baseUrlApi' => 'http://api.mingyihz.com',
    ),
    'theme' => 'v4',
);
