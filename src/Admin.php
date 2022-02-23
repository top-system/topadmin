<?php

namespace TopSystem\TopAdmin;
use Illuminate\Filesystem\Filesystem;
use TopSystem\TopAdmin\Traits\ActionTrait;
use TopSystem\TopAdmin\Traits\ModelTrait;
use TopSystem\TopAdmin\Traits\FormFieldTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use TopSystem\TopAdmin\Events\AlertsCollection;
use Arrilot\Widgets\Facade as Widget;

class Admin
{
    use FormFieldTrait;
    use ModelTrait;
    use ActionTrait;

    protected $filesystem;

    protected $viewLoadingEvents = [];

    protected $alerts = [];
    protected $alertsCollected = false;

    public $setting_cache = null;

    private $version;

    public function __construct()
    {
        $this->filesystem = app(Filesystem::class);
        $this->findVersion();
    }

    public function view($name, array $parameters = [])
    {
        foreach (Arr::get($this->viewLoadingEvents, $name, []) as $event) {
            $event($name, $parameters);
        }

        return view($name, $parameters);
    }

    public function onLoadingView($name, \Closure $closure)
    {
        if (!isset($this->viewLoadingEvents[$name])) {
            $this->viewLoadingEvents[$name] = [];
        }

        $this->viewLoadingEvents[$name][] = $closure;
    }

    public function setting($key, $default = null)
    {
        $globalCache = config('admin.settings.cache', false);

        if ($globalCache && Cache::tags('settings')->has($key)) {
            return Cache::tags('settings')->get($key);
        }

        if ($this->setting_cache === null) {
            if ($globalCache) {
                // A key is requested that is not in the cache
                // this is a good opportunity to update all keys
                // albeit not strictly necessary
                Cache::tags('settings')->flush();
            }

            foreach (self::model('Setting')->orderBy('order')->get() as $setting) {
                $keys = explode('.', $setting->key);
                @$this->setting_cache[$keys[0]][$keys[1]] = $setting->value;

                if ($globalCache) {
                    Cache::tags('settings')->forever($setting->key, $setting->value);
                }
            }
        }

        $parts = explode('.', $key);

        if (count($parts) == 2) {
            return @$this->setting_cache[$parts[0]][$parts[1]] ?: $default;
        } else {
            return @$this->setting_cache[$parts[0]] ?: $default;
        }
    }

    public function image($file, $default = '')
    {
        if (!empty($file)) {
            return str_replace('\\', '/', Storage::disk(config('admin.storage.disk'))->url($file));
        }

        return $default;
    }

    public function routes()
    {
        require __DIR__.'/../routes/admin.php';
    }

    public function addAlert(Alert $alert)
    {
        $this->alerts[] = $alert;
    }

    public function alerts()
    {
        if (!$this->alertsCollected) {
            event(new AlertsCollection($this->alerts));

            $this->alertsCollected = true;
        }

        return $this->alerts;
    }

    public function getVersion()
    {
        return $this->version;
    }

    protected function findVersion()
    {
        if (!is_null($this->version)) {
            return;
        }

        if ($this->filesystem->exists(base_path('composer.lock'))) {
            // Get the composer.lock file
            $file = json_decode(
                $this->filesystem->get(base_path('composer.lock'))
            );

            // Loop through all the packages and get the version of admin
            foreach ($file->packages as $package) {
                if ($package->name == 'TopSystem/TopAdmin') {
                    $this->version = $package->version;
                    break;
                }
            }
        }
    }

    /**
     * Get a collection of dashboard widgets.
     * Each of our widget groups contain a max of three widgets.
     * After that, we will switch to a new widget group.
     *
     * @return array - Array consisting of \Arrilot\Widget\WidgetGroup objects
     */
    public function dimmers()
    {
        $widgetClasses = config('admin.dashboard.widgets');
        $dimmerGroups = [];
        $dimmerCount = 0;
        $dimmers = Widget::group("admin::dimmers-{$dimmerCount}");

        foreach ($widgetClasses as $widgetClass) {
            $widget = app($widgetClass);

            if ($widget->shouldBeDisplayed()) {

                // Every third dimmer, we consider out WidgetGroup filled.
                // We switch that out with another WidgetGroup.
                if ($dimmerCount % 3 === 0 && $dimmerCount !== 0) {
                    $dimmerGroups[] = $dimmers;
                    $dimmerGroupTag = ceil($dimmerCount / 3);
                    $dimmers = Widget::group("admin::dimmers-{$dimmerGroupTag}");
                }

                $dimmers->addWidget($widgetClass);
                $dimmerCount++;
            }
        }

        $dimmerGroups[] = $dimmers;

        return $dimmerGroups;
    }

    public function getLocales()
    {
        $appLocales = [];
        if ($this->filesystem->exists(resource_path('lang/vendor/topadmin'))) {
            $appLocales = array_diff(scandir(resource_path('lang/vendor/topadmin')), ['..', '.']);
        }

        $vendorLocales = array_diff(scandir(realpath(__DIR__.'/../publishable/lang')), ['..', '.']);
        $allLocales = array_merge($vendorLocales, $appLocales);

        asort($allLocales);

        return $allLocales;
    }

}