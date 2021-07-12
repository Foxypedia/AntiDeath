<?php

declare(strict_types=1);

namespace Foxypedia;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\level\Level;

use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\entity\EntityDamageEvent;

class AntiDeath extends PluginBase implements Listener{
  
  /** @var string[] */
	private $enabledWorlds = [];

	/** @var string[] */
	private $disabledWorlds = [];
	
	/** @var bool */
	private $useDefaultWorld = false;
	
	public function onEnable(){
	  $this->enabledWorlds = $this->getConfig()->get("Enabled-Worlds");
	  $this->disabledWorlds = $this->getConfig()->get("Disabled-Worlds");
	  $this->useDefaultWorld = $this->getConfig()->get("Use-Default-World");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	/**
	 * @param Level $level
	 *
	 * @return bool
	 */
	public function onHunger(PlayerExhaustEvent $event) : void{
		$entity = $event->getEntity();
		if(!$entity instanceof Player){
			return;
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_ATTACK){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_DAMAGE){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_MINING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_HEALTH_REGEN){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_POTION){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_WALKING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_SPRINTING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_SWIMMING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_JUMPING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === PlayerExhaustEvent::CAUSE_SPRINT_JUMPING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
	}
	
	public function onDamage(EntityDamageEvent $event) : void{
		$entity = $event->getEntity();
		if(!$entity instanceof Player){
			return;
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_CONTACT){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_PROJECTILE){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_SUFFOCATION){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_FALL){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_FIRE){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_FIRE_TICK){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_LAVA){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_DROWNING){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_BLOCK_EXPLOSION){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_ENTITY_EXPLOSION){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_VOID){
				if($this->NoDeath($entity->getLevel())){
				  $this->saveVoid($entity);
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_SUICIDE){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_MAGIC){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_CUSTOM){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_STARVATION){
				if($this->NoDeath($entity->getLevel())){
				$event->setCancelled();
			}
		}
	}
	
	private function NoDeath(Level $level) : bool {
		if(empty($this->enabledWorlds) and empty($this->disabledWorlds)){
			return true;
		}
		$levelFolderName = $level->getFolderName();

		if(in_array($levelFolderName, $this->disabledWorlds)){
			return false;
		}
		if(in_array($levelFolderName, $this->enabledWorlds)){
			return true;
		}
		if(!empty($this->enabledWorlds) and !in_array($levelFolderName, $this->enabledWorlds)){
			return false;
		}
		return true;
	}
	
	/**
	 * @param Player $player
	 */
	private function saveVoid(Player $player) : void{
		if($this->useDefaultWorld){
			$position = $player->getServer()->getDefaultLevel()->getSpawnLocation();
		} else {
			$position = $player->getLevel()->getSpawnLocation();
		}
		$player->teleport($position);
	}
}