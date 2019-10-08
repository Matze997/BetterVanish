<?php

namespace matze\vanish;

use matze\vanish\Scheduler\VanishScheduler;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Events implements Listener{

    private $plugin;

    function __construct(vanish $plugin){
        $this->plugin = $plugin;
    }

    function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $this->plugin->vanish[$player->getName()] = false;
        $this->plugin->getScheduler()->scheduleDelayedTask(new VanishScheduler($this->plugin, $player->getPlayer()), 1);
    }

    function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $this->plugin->vanish[$player->getName()] = false;
    }
}
