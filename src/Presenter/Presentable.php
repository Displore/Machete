<?php

namespace Displore\Machete\Presenter;

trait Presentable
{
    /**
     * Hold the presenter instance.
     *
     * @var object
     */
    protected $presenterInstance;

    /**
     * Return a new or cached presenter instance.
     *
     * @throws \Exception
     * @return object
     */
    public function present()
    {
        if ( ! $this->presenter or ! class_exists($this->presenter)) {
            throw new \Exception('Please set the $presenter property in your model.');
        }

        if ( ! $this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
