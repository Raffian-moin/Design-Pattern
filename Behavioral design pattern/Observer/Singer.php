<?php

include "Listener.php";

class Singer implements SplSubject {
    protected $listeners = [];
    private $songName = "";

    public function attach(SplObserver $observer): void
    {
        $object_key = spl_object_hash($observer);
        $this->listeners[$object_key] = $observer;
    }

    public function detach(SplObserver $observer): void
    {
        $object_key = spl_object_hash($observer);
        unset($this->listeners[$object_key]);
    }


    public function notify(): void
    {
        foreach ($this->listeners as $key => $listener) {
            $listener->update($this);
        }

    }

    public function songReleased($songName)
    {
        $this->songName = $songName;
        $this->notify();
    }

    public function getSongName()
    {
        return $this->songName;
    }
}

$object = new Singer();
$listener1 = new Listener();
$listener2 = new Listener();
$listener3 = new Listener();

$object->attach($listener1);
$object->attach($listener2);
$object->attach($listener3);
$object->detach($listener2);

$object->songReleased("Summer time sadness");

// Publisher class: Class that is responsible to track the change in the class and notifies the subscribers classes.

// Subscriber class: Class that receives updates from Publisher class.

/**
 * This is a subject/publisher class which implements PHP's
 * built-in SplSubject interface. When something happens to
 * this class object, this object triggers notify() method that
 * will in return call update() method of subscribers classes
 */

