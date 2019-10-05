<?php

namespace matze\vanish\Command;

use matze\vanish\vanish;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class VanishCommand extends Command{

    private $plugin;

    function __construct(vanish $plugin){
        $this->plugin = $plugin;
        $cfg = $this->plugin->getConfig();
        parent::__construct($cfg->get("Command"), $cfg->get("Description"), $cfg->get("Usage"), $cfg->get("Aliase"));
        $this->setPermission($cfg->get("Permission"));
    }

    function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            $cfg = $this->plugin->getConfig();
            if($sender->hasPermission($cfg->get("Permission"))){
                if($this->plugin->vanish[$sender->getName()] === false){
                    $sender->sendMessage($cfg->get("vanish.on"));
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $onlinePlayer){
                        $onlinePlayer->hidePlayer($sender);
                    }
                    $this->plugin->vanish[$sender->getName()] = true;

                    var_dump($this->plugin->vanish[$sender->getName()]);
                } else {
                    $sender->sendMessage($cfg->get("vanish.off"));
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $onlinePlayer){
                        $onlinePlayer->showPlayer($sender);
                    }

                    $this->plugin->vanish[$sender->getName()] = false;

                    var_dump($this->plugin->vanish[$sender->getName()]);
                }
            }
        }
    }
}