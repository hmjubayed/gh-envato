<?php

namespace Database\Seeders;

use Backend\Models\Menu;
use Backend\Models\MenuItem;
use Illuminate\Database\Seeder;

class BackendMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $menu = Menu::where("name", "main")->firstOrNew();
        $menuItem = MenuItem::firstOrNew([
            "menu_id" => $menu->id,
            "title"   => "menus.backend.main.pages",
            "route"    => 'backend.pages.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                "target"     => "_self",
                "icon" => "file-text",
                "parent_id"  => 0,
                "order"      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            "menu_id" => $menu->id,
            "title"   => "menus.backend.main.posts",
            "route"    => 'backend.posts.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                "target"     => "_self",
                "icon" => "file",
                "parent_id"  => 0,
                "order"      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            "menu_id" => $menu->id,
            "title"   => "menus.backend.main.gh-envato",
            "route"    => 'backend.envato-products.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                "target"     => "_self",
                "icon" => "github",
                "parent_id"  => 0,
                "order"      => 1,
            ])->save();
        }

        // site menus
        
    }
}
