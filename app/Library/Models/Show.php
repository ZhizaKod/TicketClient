<?php

namespace App\Library\Models;


/**
 * Class Show
 * @package App\Library\Models
 */
class Show
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * Show constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

}
