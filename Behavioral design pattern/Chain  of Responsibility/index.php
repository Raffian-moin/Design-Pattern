<?php

interface handleInterface
{
    public function setNext(handleInterface $obj);
    public function getNext();
    public function handle($className);
}

abstract class abstractHandler implements handleInterface
{
    protected $next;

    public function setNext($obj)
    {
        $this->next = $obj;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function handle($className)
    {
        $this->next->handle($className);
    }
}

class Test1 extends abstractHandler
{
    public function handle($className)
    {
        if (__CLASS__  === $className) {
            echo <<<EOD
            I'm {$className} class
            Don't go further in the request
            EOD;

            return;
        }

        parent::handle($className);
    }


}

class Test2 extends abstractHandler
{
    public function handle($className)
    {
        if (__CLASS__  === $className) {
            echo <<<EOD
            I'm {$className} class
            Don't go further in the request
            EOD;

            return;

        }

        parent::handle($className);
    }
}

class Test3 extends abstractHandler
{
    public function handle($className)
    {
        if (__CLASS__  === $className) {
            echo <<<EOD
            I'm {$className} class
            Don't go further in the request
            EOD;

            return;
        }

        parent::handle($className);
    }
}

$test1 = new Test1();
$test2 = new Test2();
$test3 = new Test3();

$test1->setNext($test2);
$test2->setNext($test3);

$test1->handle('Test2');

