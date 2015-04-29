<?php

/**
 * 模型基类
 *
 * @author Jiankang.Wang
 */
class ActiveRecord extends CActiveRecord {

    protected $belongTo;

    public function __construct($scenario = 'insert') {
        $this->belongTo = $this->modulName();
        parent::__construct($scenario);
    }

    public function getDbConnection() {

        if (!$this->isBelongToModule()) {
            return parent::getDbConnection();
        }
        $module = Yii::app()->getModule($this->belongTo);
        if (!($module instanceof WebModule) || empty($module->db)) {
            return parent::getDbConnection();
        }
        if (self::$db !== null) {
            return self::$db;
        } else {

            $connection = new CDbConnection();
            foreach ($module->db as $property => $value) {
                if (property_exists($connection, $property)) {
                    $connection->$property = $value;
                }
            }
            $connection->active = true;
            self::$db = $connection;
            return self::$db;
        }
    }

    protected function modulName() {
        $thisModule = $this->moduleFile();
        if ($thisModule) {
            $modules = array();
            foreach (Yii::app()->modules as $m => $opt) {
                $modules[$m] = Yii::getPathOfAlias($opt['class']) . '.php';
            }
            return array_search($thisModule, $modules);
        }
        return false;
    }

    protected function moduleFile() {
        $files = scandir($this->path() . '/../');
        foreach ($files as $file) {
            if (preg_match('/^\w+Module\.php$/', $file)) {
                return realpath($this->path() . '/../' . $file);
            }
        }
        return false;
    }

    protected function path() {
        $class = get_class($this);
        $reflect = new ReflectionClass($class);
        return dirname($reflect->getFileName());
    }

    public function isBelongToModule() {
        return !empty($this->belongTo);
    }

}
