<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Polymorphics\ProfileRepository::class, \App\Repositories\Polymorphics\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Polymorphics\AddressRepository::class, \App\Repositories\Polymorphics\AddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Polymorphics\AttachmentRepository::class, \App\Repositories\Polymorphics\AttachmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Polymorphics\AffiliateRepository::class, \App\Repositories\Polymorphics\AffiliateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Polymorphics\TagRepository::class, \App\Repositories\Polymorphics\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Polymorphics\CategoryRepository::class, \App\Repositories\Polymorphics\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Posts\PostRepository::class, \App\Repositories\Posts\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Posts\BlogPostRepository::class, \App\Repositories\Posts\BlogPostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Posts\PageRepository::class, \App\Repositories\Posts\PageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Posts\SliderRepository::class, \App\Repositories\Posts\SliderRepositoryEloquent::class);
        //:end-bindings:
    }
}
