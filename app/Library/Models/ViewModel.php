<?php

namespace App\Library\Models;

/**
 * Class Place
 * @package App\Library\Models
 */

class ViewModel
{
    /** @var int */
    public $id;

    /** @var ViewModelProperty[] */
    public $properties;

    /**
     * ViewModel constructor.
     * @param int $id
     */
    public function __construct(int $id, /** @var \App\Models\Place[] $places */ $properties = [] )
    {
      $this->id = $id;
      $this->properties = $properties;
    }

}

/**
 * Class ViewModelProperty
 * @package App\Library\Models
 */

class ViewModelProperty {

    /** @var string */
    public $name;
    /** @var string */
    public $Value;

    public function __construct(string $name, string $value){
        $this->name = $name;
        $this->value = $value;
    }

}
