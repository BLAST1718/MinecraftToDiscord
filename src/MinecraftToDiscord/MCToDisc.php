<?php

namespace MinecraftToDiscord;

use MinecraftToDiscord\Discord\DiscordManager;
use MinecraftToDiscord\EventListeners\EventListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class MCToDIsc extends PluginBase{

     function onEnable(): void{
		 if (!is_dir($this->getDataFolder())){
			 mkdir($this->getDataFolder());
		 }
		 $this->saveResource("config.yml");
		 $config = new Config($this->getDataFolder() . "config.yml");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$webhook = $config->get("weebhook");
		DiscordManager::postWebhook($webhook, "Plugin Enabled", "");

    }

    function onDisable()
	{
		$config = new Config($this->getDataFolder() . "config.yml");
		$webhook = $config->get("weebhook");
		DiscordManager::postWebhook($webhook, "Plugin Disabled", "");
	}
}
