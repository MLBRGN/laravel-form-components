<?php

namespace Mlbrgn\LaravelFormComponents\Support;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Mlbrgn\LaravelFormComponents\FormDataBinder;
use Mlbrgn\LaravelFormComponents\View\Components\Captcha;
use Mlbrgn\LaravelFormComponents\View\Components\Checkbox;
use Mlbrgn\LaravelFormComponents\View\Components\Errors;
use Mlbrgn\LaravelFormComponents\View\Components\Form;
use Mlbrgn\LaravelFormComponents\View\Components\Group;
use Mlbrgn\LaravelFormComponents\View\Components\HtmlEditor;
use Mlbrgn\LaravelFormComponents\View\Components\Inline;
use Mlbrgn\LaravelFormComponents\View\Components\Input;
use Mlbrgn\LaravelFormComponents\View\Components\InputGroup;
use Mlbrgn\LaravelFormComponents\View\Components\InputGroupText;
use Mlbrgn\LaravelFormComponents\View\Components\Label;
use Mlbrgn\LaravelFormComponents\View\Components\Radio;
use Mlbrgn\LaravelFormComponents\View\Components\Range;
use Mlbrgn\LaravelFormComponents\View\Components\Select;
use Mlbrgn\LaravelFormComponents\View\Components\Submit;
use Mlbrgn\LaravelFormComponents\View\Components\Test;
use Mlbrgn\LaravelFormComponents\View\Components\Textarea;

class ServiceProvider extends BaseServiceProvider
{

    private const PATH_VIEWS = __DIR__ . '/../../resources/views/';
    private const CONFIG_FILE = __DIR__ . '/../../config/config.php';
    public static string $VIEW_NAMESPACE = 'laravel-form-components';

    public function boot(): void
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
               self::CONFIG_FILE => config_path('form-components.php'),
            ], 'config');

//  Don't want to publish views should all be in vendor package
//            $this->publishes([
//                __DIR__ . '/../../resources/views' => base_path('resources/View/vendor/form-components'),
//            ], 'View');
        }

        // method 1 of loading view components
        $this->loadViewsFrom(realpath(self::PATH_VIEWS), config('form-components.view_namespace'));
        $this->configureComponents();

        // method 2 of loading view components
        $this->loadViewComponentsAs('mlbrgn', $this->viewComponents());

        // method 3 of registering view components
        Blade::componentNamespace('Mlbrgn\LaravelFormComponents\View\Components', config('form-components.tag_prefix'));

        Blade::directive('bind', function ($bind) {
            return '<?php app(\Mlbrgn\LaravelFormComponents\FormDataBinder::class)->bind(' . $bind . '); ?>';
        });

        Blade::directive('endbind', function () {
            return '<?php app(\Mlbrgn\LaravelFormComponents\FormDataBinder::class)->pop(); ?>';
        });

    }

    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('captcha', Captcha::class);
            $this->registerComponent('checkbox', Checkbox::class);
            $this->registerComponent('errors', Errors::class);
            $this->registerComponent('form', Form::class);
            $this->registerComponent('group', Group::class);
            $this->registerComponent('html-editor', HtmlEditor::class);
            $this->registerComponent('inline', Inline::class);
            $this->registerComponent('input', Input::class);
            $this->registerComponent('input-group', InputGroup::class);
            $this->registerComponent('input-group-text', InputGroupText::class);
            $this->registerComponent('label', Label::class);
            $this->registerComponent('radio', Radio::class);
            $this->registerComponent('range', Range::class);
            $this->registerComponent('select', Select::class);
            $this->registerComponent('submit', Submit::class);
            $this->registerComponent('textarea', Textarea::class);
        });
    }

    // tagAlias will become tag name (e.g. $tagAlias = 'abc' -> tag will be <x-abc/>)
    protected function registerComponent(string $tagAlias, string $class): void
    {
        Blade::component($tagAlias, $class);
    }

    protected function viewComponents(): array
    {
        return [
            Input::class,
            Test::class
        ];
    }

    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_FILE, 'form-components');

        $this->app->singleton(FormDataBinder::class, fn () => new FormDataBinder);
    }
}
