<?php
namespace GamemodeUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
    
  public function onEnable(){
    $this->getLogger()->info("§l§aPlugin Enable");
  }
    
  public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool {
    switch($cmd->getName()) {
      case "gui":
        if ($sender instanceof Player) {
          $this->gui($sender);
          } else{
                $sender->sendMessage("§l§cUse Command In Game");
          }
        }
      return true;
    }
    
    public function gui($player){
      $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
        if($data == null){
          return true;
        }
        switch($data){
          case 0:
            $player->sendMessage("§l§f[§gGamemodeUI§f] §l§cExit Gamemode UI");
            break;
          case 1:
            $player->sendMessage("§l§f[§gGamemodeUI§f] §aChange Survival");
            $player->setGamemode(Player::SURVIVAL);
            break;
          case 2:
            $player->sendMessage("§l§f[§gGamemodeUI§f] §aChange Creative");
            $player->setGamemode(Player::CREATIVE);
            break;
          case 3:
            $player->sendMessage("§l§f[§gGamemodeUI§f] §aChange Spectator");
            $player->setGamemode(Player::SPECTATOR);
            break;
          case 4:
            $player->sendMessage("§l§f[§gGamemodeUI§f] §aChange Spectator");
            $player->setGamemode(Player::ADVENTURE);
            break;
        }
      });
      
      $form->setTitle("§l§gGamemodeUI");
      $form->addButton("§l§cExit \n§r§fTap To Exit", 0, "op");
      $form->addButton("§l§6Survival \n§r§fTap To Survival", 1, "textures/ui/op");
      $form->addButton("§l§6Creative \n§r§fTap To Creative", 2, "textures/ui/op");
      $form->addButton("§l§6Spectator \n§r§fTap To Spectator", 3, "textures/ui/op");
      $form->addButton("§l§6Adventure \n§r§fTap To Adventure", 4, "textures/ui/op");
      
      $form->sendToPlayer($player);
      return $form;
  }
