<?php
namespace TopSystem\TopAdmin\Traits;

use TopSystem\TopAdmin\Models\Category;
use TopSystem\TopAdmin\Models\DataType;
use TopSystem\TopAdmin\Models\DataRow;
use TopSystem\TopAdmin\Models\Menu;
use TopSystem\TopAdmin\Models\MenuItem;
use TopSystem\TopAdmin\Models\Page;
use TopSystem\TopAdmin\Models\Permission;
use TopSystem\TopAdmin\Models\Post;
use TopSystem\TopAdmin\Models\Role;
use TopSystem\TopAdmin\Models\Setting;
use TopSystem\TopAdmin\Models\User;
use TopSystem\TopAdmin\Models\Translation;

trait ModelTrait{
    protected $models = [
        'DataRow'     => DataRow::class,
        'DataType'    => DataType::class,
        'Menu'        => Menu::class,
        'MenuItem'    => MenuItem::class,
        'Permission'  => Permission::class,
        'Role'        => Role::class,
        'Setting'     => Setting::class,
        'User'        => User::class,
        'Translation' => Translation::class,
        'Category'    => Category::class,
        'Post'        => Post::class,
        'Page'        => Page::class
    ];

    public function model($name)
    {
        return app($this->models[\Illuminate\Support\Str::studly($name)]);
    }

    public function modelClass($name)
    {
        return $this->models[$name];
    }

    public function useModel($name, $object)
    {
        if (is_string($object)) {
            $object = app($object);
        }

        $class = get_class($object);

        if (isset($this->models[\Illuminate\Support\Str::studly($name)]) && !$object instanceof $this->models[\Illuminate\Support\Str::studly($name)]) {
            throw new \Exception("[{$class}] must be instance of [{$this->models[\Illuminate\Support\Str::studly($name)]}].");
        }

        $this->models[\Illuminate\Support\Str::studly($name)] = $class;

        return $this;
    }

}
