<?php

class Listener implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo $subject->getSongName(). "\n";
    }
}
