<?php

namespace MinecraftToDiscord\EventListeners;

use MinecraftToDiscord\Discord\DiscordManager;
use MinecraftToDiscord\MCToDisc;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\CommandEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\utils\Config;

class EventListener implements Listener {

	private $main;

	public function __construct(MCToDisc $main)
	{
		$this->main = $main;
	}

	public function onCommandUse(CommandEvent $ev): void
	{
		$player = $ev->getSender();
		if ($player instanceof Player) {
			$config = new Config($this->main->getDataFolder() . "config.yml");
			$webhook = $config->get("weebhook");
			DiscordManager::postWebhook($webhook, "[" . $player->getName() . "] `/" . $ev->getCommand() . "`", "");
		}
	}

	public function oonPlayerJoin(PlayerJoinEvent $ev): void
	{
		$player = $ev->getPlayer();
		if ($player) {
			$config = new Config($this->main->getDataFolder() . "config.yml");
			$webhook = $config->get("weebhook");
			DiscordManager::postWebhook($webhook, (+) . $player->getName() . " joined the server.", "");
		}
	}

	public function onPlayerLeave(PlayerQuitEvent $ev): void
	{
		$player = $ev->getPlayer();
		if ($player) {
			$config = new Config($this->main->getDataFolder() . "config.yml");
			$webhook = $config->get("weebhook");
			DiscordManager::postWebhook($webhook, (+) . $player->getName() . " Left the server.", "");
		}
	}

	public function onPlayerChat(PlayerChatEvent $ev): void
	{
		$player = $ev->getPlayer();
		if ($player) {
			$config = new Config($this->main->getDataFolder() . "config.yml");
			$webhook = $config->get("weebhook");
			DiscordManager::postWebhook($webhook, "[" . $player->getName() . "] ```" . $ev->getMessage() . "```", "");
		}
	}
}
