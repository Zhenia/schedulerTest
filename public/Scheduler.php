<?php

namespace App;
use App\Application as Application;
use App\SourceManager as SourceManager;
class Scheduler
{
    private $applications = [];

    public function __construct(){
    }

    public function addApplication(Application $application){
        $this->applications[$application->getId()] = $application;
    }

    public function load($count, $start = 1){
        for($i = $start; $i<$count; $i++){
            $application = $this->loadApplicationById($i);
            $this->applications[$i] = $application;
        }
        return $this->applications;
    }

    public function save(){

    }

    public function loadApplicationById($id){
        $sm = new SourceManager();
        $allChecks = $sm->loadApplicationById($id);
        $checks = ($allChecks)?explode(',',$allChecks ):[];
        $app = new Application();
        $app->setId($id);
        $app->setChecks($checks);
        return $app;
    }

    public function getApplicationsByCheckTime($time){
        $result = [];
        foreach($this->applications as $app){
            if (in_array($time, $app->getChecks())){
                $result[] = $app->getId();
            }
        }
        return $result;
    }

    public function getApplicationById($id){
        return (array_key_exists($id,$this->applications))?$this->applications[$id]:false;

    }

    public function removeById($id){
        unset($this->applications[$id]);
        $this->save();
        return $this;
    }

}