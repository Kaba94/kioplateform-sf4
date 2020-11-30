<?php

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Routeur[]
     */
    public $routeur = [];
    
    /**
     * @var Base[]
     */
    public $base = [];
    
    /**
     * @var Annonceur[]
     */
    public $annonceur = [];
    
    /**
     * @var Campagne[]
     */
    public $campagne = [];
    
    /**
     * @var Plateform[]
     */
    public $plateform = [];

    /**
     * @var boolean
     */
    public $test = false;
}
