<?php

# A plugin for PocketMine-MP that will show rules of a server in an UI form.
# Copyright (C) 2020 Kygekraqmak
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.

namespace Kygekraqmak\KygekRulesUI\commands;

use pocketmine\command\{Command, CommandSender};
use pocketmine\Server;
use pocketmine\Player;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use Kygekraqmak\KygekRulesUI\Main;

class Rules extends Command {

  public function __construct($name, Main $plugin) {
    $this->main = $plugin;
    $config = $this->main->getConfig();
    parent::__construct("rules");
    $this->setDescription($config->get("command-description"));
    $this->setAliases($config->get("command-aliases"));
  }

  public function onCommand(CommandSender $player, Command $cmd, string $label, array $args) : bool {
    switch ($cmd->getName()) {
      case "rules":
      case $this->main->getConfig()->get("command-aliases"):
      if (!$player instanceof Player) {
        $player->sendMessage("[KygekRulesUI] This command only works in game!");
      } else {
        if (!$player->hasPermission("rules.command")) {
          $player->sendMessage("[KygekRulesUI] You do not have permission to use this command!");
        } else {
          $this->main->getConfig()->reload();
          $this->main->kygekRulesUI($player);
        }
      }
    }
    return true;
  }

}