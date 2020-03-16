<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         *
         */
        \Blade::if('admin', function() {
            return \Auth::user()->isAdministrator();
        });

        /**
         * Outputs a meta tag with the provided name and content value - these tags are read in by the js meta service
         * to provide an easy interface to additional document details - json encodes and specifies json format for
         * arrays/objects (handled appropriately by js service)
         *
         * Usage:
         *
         *    @meta('number-of-tries', 5)
         *    @meta('office-id', $office->id)
         *    @meta('message', $message)
         */
        \Blade::directive('meta', function($expression) {
            return '<?php
                        $isJson = "0";
                        list ($name, $value) = [' . $expression . '];
                        if (is_array($value) || is_object($value)) {
                            $value = json_encode($value, JSON_HEX_APOS);
                            $isJson = "1";
                        } else {
                            $value = e($value);
                        }
                        echo "<meta data-json=\"$isJson\" name=\"" . e($name) . "\" content=\'" . $value . "\'>";
                    ?>';
        });
        /**
         * Outputs a style tag for the provided stylesheet. Include the leading 'css/'
         *
         * Usage:
         *
         *    @style('css/app.css')
         *    @style('css/dashboard.css')
         *    @style('css/organization.edit.css')
         */
        \Blade::directive('style', function($expression) {
            return <<<EOT
<?php echo "<link rel='stylesheet' href='" . mix({$expression}) . "'>"; ?>
EOT;
        });
        /**
         * Outputs a script tag for the provided script. Include the leading 'js/'
         *
         * Usage:
         *
         *    @style('js/app.js')
         *    @style('js/dashboard.js')
         *    @style('js/organization.edit.js')
         */
        \Blade::directive('script', function($expression) {
            return <<<EOT
<?php echo "<script type='text/javascript' src='" . mix({$expression}) . "'></script>"; ?>
EOT;
        });



        /**
         * Outputs a Fomantic UI error message container with the errors for the provided keys
         * The complex methods for passing in fields allows for providing values of possibly unknown types, e.g. named
         * variables containing arrays or strings, etc.
         *
         * Usage:
         *
         *    @errors('name')
         *    @errors('name', 'email')
         *    @errors(['name', 'email'])
         *    @errors(['name'], 'email')
         */
        \Blade::directive('errors', function($expression) {
            return '<?php
                $_fields = collect([' . $expression . '])->flatten()->toArray();
                if ($errors->hasAny($_fields)) {
                $_errorMessages = [];
                foreach ($_fields as $_field) {
                    if ($errors->has($_field)) {
                        $_errorMessages[] = e($errors->first($_field));
                    }
                }
                echo "<div class=\"alert alert-danger\">";
                echo implode("<br>", $_errorMessages);
                echo "</div>";
            }?>';
        });



        \Blade::include('_form/text',              'textField');
        \Blade::include('_form/email',             'emailField');
        \Blade::include('_form/password',          'passwordField');
        \Blade::include('_form/hidden',            'hiddenField');
        \Blade::include('_form/select',            'selectField');
        \Blade::include('_form/user-select',       'userSelectField');
        \Blade::include('_form/team-multi-select', 'teamMultiSelectField');
        \Blade::include('_form/checkboxSwitch',    'checkboxSwitchField');
        \Blade::include('_form/date',              'dateField');
        \Blade::include('_form/phone',             'phoneField');
        \Blade::include('_form/money',             'moneyField');
        \Blade::include('_form/textarea',          'textareaField');
        \Blade::include('_form/text-editor',       'textEditorField');
    }
}
