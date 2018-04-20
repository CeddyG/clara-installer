<?php

namespace CeddyG\ClaraInstaller\Events;

class AfterInstallEvent
{
    public $aInputs;
    
    /**
     * Create a new event instance.
     *
     * @param  array  $aInputs
     * 
     * @return void
     */
    public function __construct(array $aInputs)
    {
        $this->aInputs = $aInputs;
    }
}
