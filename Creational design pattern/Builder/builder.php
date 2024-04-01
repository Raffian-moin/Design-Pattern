<?php

class PC
{
    public $processor;
    public $motherBoard;
    public $ram;
    public $storage;
    public $powerSupply;
    public $graphicsCard;
    public $caseFan;
}

class GenericPC extends PC
{
    public function __toString()
    {
        return <<<EOD
        Your PC is built with the following configurations:
        Processor: {$this->processor}
        Mother Board: {$this->motherBoard}
        EOD;
    }
}

class GamingPC extends PC
{
    public function __toString()
    {
        return <<<EOD
        Your PC is built with the following configurations:
        Processor: {$this->processor}
        Mother Board: {$this->motherBoard}
        Graphics Card: {$this->graphicsCard}
        EOD;
    }
}

interface PCBuilder
{
    public function buildPc();

    public function getPC();
}

class GenericPCBuilder implements PCBuilder
{
    private $pc;
    private $configurations;

    public function __construct($configurations)
    {
        $this->configurations = $configurations;
        $this->pc = new GenericPC();
        $this->buildPc();
    }

    public function setProcessor()
    {
        $this->pc->processor = $this->configurations['processor'];
        return $this;
    }

    public function setMotherBoard()
    {
        $this->pc->motherBoard = $this->configurations['motherBoard'];
        return $this;
    }

    public function buildPc()
    {
        $this->setProcessor()->setMotherBoard();
    }

    public function getPC()
    {
        return $this->pc;
    }
}

class GamingPCBuilder implements PCBuilder
{
    private $pc;
    private $configurations;

    public function __construct($configurations)
    {
        $this->configurations = $configurations;
        $this->pc = new GamingPC();
        $this->buildPc();
    }

    public function setProcessor()
    {
        $this->pc->processor = $this->configurations['processor'];
        return $this;
    }

    public function setMotherBoard()
    {
        $this->pc->motherBoard = $this->configurations['motherBoard'];
        return $this;
    }

    public function setGraphicsCard()
    {
        $this->pc->graphicsCard = $this->configurations['graphicsCard'];
        return $this;
    }

    public function buildPc()
    {
        $this->setProcessor()->setMotherBoard()->setGraphicsCard();
    }

    public function getPC()
    {
        return $this->pc;
    }
}

$genericPCBuilder = new GenericPCBuilder([
    "processor" => "Core i5",
    "motherBoard" => "AMD AM4",
]);

echo $genericPCBuilder->getPC();

echo "\n\n";

$gamingPCBuilder = new GamingPCBuilder([
    "processor" => "Core i5",
    "motherBoard" => "AMD AM4",
    "graphicsCard" => "MSI GT 710 2GD3H LP 2GB DDR3",
]);

echo $gamingPCBuilder->getPC();