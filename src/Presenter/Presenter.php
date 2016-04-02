<?php

namespace Displore\Machete\Presenter;

abstract class Presenter
{
    /**
     * The presentable model.
     * 
     * @var object
     */
    protected $model;

    /**
     * Create a new presenter instance.
     * 
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(\Illuminate\Database\Eloquent\Model $model)
    {
        $this->model = $model;
    }

    /**
     * This allows for property-style retrieval.
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }
    }
}
