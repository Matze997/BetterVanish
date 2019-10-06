<?php

namespace matze\vanish;

use matze\vanish\Command\VanishCommand;
use matze\vanish\Scheduler\VanishScheduler;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class vanish extends PluginBase implements Listener{

    public $vanish = [];

    function onEnable(){
        @mkdir($this->getDataFolder());
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new Events($this), $this);
        $this->getServer()->getCommandMap()->register("BetterVanish", new VanishCommand($this));
    }
}
