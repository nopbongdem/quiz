<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lang;
use Menu;

class MenuServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		Menu::make('home', function ($menu) {
			$menu->add(Lang::get('labels.dashboard'), 'admin/dashboard')->icon('dashboard')->active('admin/dashboard');
			$menu->add(Lang::get('labels.category'), 'admin/category')->icon('graduation-cap')->active('admin/category/*');
			$menu->add(Lang::get('labels.question'), 'admin/question')->icon('graduation-cap')->active('admin/question/*');
			$menu->add(Lang::get('labels.media'), 'admin/media')->icon('camera')->active('admin/media/*');
			$menu->add(Lang::get('labels.documentation'), 'admin/documentation')->icon('book')->active('admin/documentation/*');

		});

		Menu::make('default', function ($menu) {
			$menu->add(Lang::get('labels.story'), 'story')->icon('newspaper-o')->active('story/*');

		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
