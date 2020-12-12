<?php

namespace spawn;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerItemDropEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\TextFormat as TF;
use pocketmine\plugin\PluginBase;
use pocketmine\block\Air;
use pocketmine\block\Grass;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\item\Armor;
use pocketmine\block\Block;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\item\IronBoots;
use pocketmine\item\IronChestplate;
use pocketmine\item\IronLeggings;
use pocketmine\item\IronHelmet;
use pocketmine\item\DiamondBoots;
use pocketmine\item\DiamondChestplate;
use pocketmine\item\DiamondLeggings;
use pocketmine\item\DiamondHelmet;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\inventory\Inventory;
use pocketmine\math\Vector3;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Effect;
use pocketmine\event\inventory\CraftItemEvent;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Spawn plugin chargé !");
    }

    public function onDisable(){
        $this->getLogger()->info("Spawn plugin déchargé");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){
	    case "spawn":
		if($sender instanceof Player){
		    $sender->sendMessage("§aVous avez été téléporté au spawn!");
		    $sender->teleport($this->getServer()->getLevelByName("world")->getSpawnLocation());
		}
	    break;
        }
        switch($cmd->getName()){
            case "setspawn":
                if($sender->hasPermission("setspawn.use")){
                    $sender->getLevel()->setSpawnLocation($sender);
                    $sender->getServer()->setDefaultLevel($sender->getLevel());
                    $sender->sendMessage("§r§aSpawn principale mise à jour !\n§eX:§7 " . $sender->getX() . "\n§eY:§7 " . $sender->getY() . "\n§eZ:§7 " . $sender->getZ());
                }
            break;
        }
        return true;
    }
}
