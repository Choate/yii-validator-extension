<?php
/**
 * 邢帅教育
 *
 * 本源代码由邢帅教育及其作者共同所有，未经版权持有者的事先书面授权，
 * 不得使用、复制、修改、合并、发布、分发和/或销售本源代码的副本。
 *
 * @copyright Copyright (c) 2013 xsteach.com all rights reserved.
 */

namespace choateunit\validators\unit;

use Codeception\TestCase\Test;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\Container;

/**
 * Class TestCase
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choateunit\validators\unit
 */
class TestCase extends Test
{
    public $appConfig = [
        'id'         => 'test',
        'basePath'   => __DIR__,
        'language'   => 'en-US',
        'bootstrap'  => ['choate\validators\Validator'],
        'components' => [
            'mailer'     => [
                'useFileTransport' => true,
            ],
            'urlManager' => [
                'showScriptName' => true,
            ],
        ],
    ];

    /**
     * @inheritdoc
     */
    protected function setUp() {
        parent::setUp();
        $this->mockApplication();
    }

    /**
     * Mocks up the application instance.
     *
     * @param array $config the configuration that should be used to generate the application instance.
     * If null, [[appConfig]] will be used.
     *
     * @return \yii\web\Application|\yii\console\Application the application instance
     * @throws InvalidConfigException if the application configuration is invalid
     */
    protected function mockApplication($config = null) {
        if (isset(Yii::$app)) {
            return;
        }
        Yii::$container = new Container();
        $config = $config === null ? $this->appConfig : $config;
        if (is_string($config)) {
            $configFile = Yii::getAlias($config);
            if (!is_file($configFile)) {
                throw new InvalidConfigException("The application configuration file does not exist: $config");
            }
            $config = require($configFile);
        }
        if (is_array($config)) {
            if (!isset($config['class'])) {
                $config['class'] = 'yii\web\Application';
            }
            return Yii::createObject($config);
        } else {
            throw new InvalidConfigException('Please provide a configuration array to mock up an application.');
        }
    }

    /**
     * @inheritdoc
     */
    protected function tearDown() {
        $this->destroyApplication();
        parent::tearDown();
    }

    /**
     * Destroys the application instance created by [[mockApplication]].
     */
    protected function destroyApplication() {
        if (\Yii::$app) {
            if (\Yii::$app->has('session', true)) {
                \Yii::$app->session->close();
            }
            if (\Yii::$app->has('db', true)) {
                Yii::$app->db->close();
            }
        }
        Yii::$app = null;
        Yii::$container = new Container();
    }
}