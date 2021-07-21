<?php declare(strict_types = 1);

namespace App;

class ErrorHandler
{
    protected $observers = [];
    protected $errorInfo;

    public function attach($observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach($observer): void
    {
        foreach (array_keys($this->observers) as $key) {
            if ($this->boservers[$key] === $observer) {
                unset($this->observers[$key]);
                return;
            }
        }
    }

    public function notify(): void
    {
        foreach (array_keys($this->observer) as $key) {
            $observer = $this->observers[$key];
            $observer->update($this);
        }
    }

    public function getState()
    {
        return $this->errorInfo;
    }

    public function setState($info): void
    {
        $this->errorInfo = $info;
        $this->notify();
    }
}