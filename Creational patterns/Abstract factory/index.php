<?php

/*
 * Когда у нас есть воркеры, они делятся на девелоперов и дизайнеров.
 * И эи воркеры ещё могут делиться на аутсорс или внутри.
 * Если езё как-то классифицируются нужна абстрактная фабрика.
*/

interface AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker;
    public static function makeDesignerWorker(): DesignerWorker;
    public static function makeTesterWorker(): TesterWorker;
}

class OutsourceWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }

    public static function makeTesterWorker(): TesterWorker
    {
        return new OutsourceTesterWorker();
    }
}

class NativeWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }

    public static function makeTesterWorker(): TesterWorker
    {
        return new NativeTesterWorker();
    }
}

interface Worker
{
    public function work();
}

interface DeveloperWorker extends Worker
{

}

interface DesignerWorker extends Worker
{

}

interface TesterWorker extends Worker
{

}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf("Im developing as native \n");
    }
}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf("Im developing as outsource \n");
    }
}

class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf("Im designer as native \n");
    }
}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf("Im designer as outsource \n");
    }
}

class NativeTesterWorker implements TesterWorker
{
    public function work()
    {
        printf("Im tester as native \n");
    }
}

class OutsourceTesterWorker implements TesterWorker
{
    public function work()
    {
        printf("Im tester as outsource \n");
    }
}


$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();
$nativeDeveloper->work();

$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();
$outsourceDeveloper->work();

$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();
$nativeDesigner->work();

$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();
$outsourceDesigner->work();

$nativeTester = NativeWorkerFactory::makeTesterWorker();
$nativeTester->work();

$outsourceTester = OutsourceWorkerFactory::makeTesterWorker();
$outsourceTester->work();