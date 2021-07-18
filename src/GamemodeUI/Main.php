<?php

namespace gamemodeui;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("§l§aPlugin Enable!");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function onLoad(){
        $this->getLogger()->info("§l§6Plugin Load...");
    }

    public function onEnable(){
        $this->getLogger()->info("§l§cPlugin Disable, Not Detected FormAPI");
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
      if($command->getName() === "gui"){
        if($sender->hasPermission("gui.cmd")){
        switch($cmd->getName()){
            case "gui":
                if($sender instanceof Player){
                    $this->openMyForm($sender);
                    return true;
                }else{
                    $sender->sendMessage("§l§cUse this cmd in Game!");
                }
            break;
        }
        return true;
    }
    
    public function openMyForm($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function(Player $sender, int $data = null) {
            $result = $data;
            if($result == null){
                return true;
            }
            switch($result){
                case 0:
                    $sender->sendMessage("§l§aClose GamemodeUI");
                break;

                case 1:
                    $this->getServer()->getCommandMap()->dispatch($sender, "gamemode survival");
                break;

                case 2:
                    $this->getServer()->getCommandMap()->dispatch($sender, "gamemode survival");
                break;
                
                case 3:
                    $this->getServer()->getCommandMap()->dispatch($sender, "gamemode spectator");
                break;

                case 4:
                    $this->getServer()->getCommandMap()->dispatch($sender, "gamemode adventure");
                break;

            }
        });
        $form->setTitle("§l§gGAMEMODEUI");
        $form->setContent("§6Choose Your Gamemode");
        $form->addButton("§c§lExit", 0, "textures/ui/cancel");
        $form->addButton("§6§lGamemode Survival", 1, "textures/ui/op");
        $form->addButton("§6§lGamemode Creative", 2, "textures/ui/op");
        $form->addButton("§6§lGamemode Spectator", 3, "textures/ui/op");
        $form->addButton("§6§lGamemode Adventure", 4, "textures/ui/op");
        $form->sendToPlayer($sender);
        return $form;
    }
}
