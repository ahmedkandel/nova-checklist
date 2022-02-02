<?php

namespace Ahmedkandel\NovaChecklist;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Checklist extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-checklist';

    /**
     * Create a new field.
     *
     * @return void
     */
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->withMeta([
            'placeholder' => __('Add item'),
            'canEdit' => true,
        ]);
    }

    /**
     * Specify the placeholder text for the "add new item field".
     *
     * @param  string  $text
     * @return $this
     */
    public function placeholder($text)
    {
        return $this->withMeta(['placeholder' => $text]);
    }

    /**
     * Show the item number when adding new item.
     *
     * @return $this
     */
    public function placeholderCounter()
    {
        return $this->withMeta(['placeholderCounter' => true]);
    }

    /**
     * Save which user created or completed the item.
     *
     * @param  string  $column
     * @return $this
     */
    public function storeUserName($column = 'name')
    {
        return $this->withMeta(['user' => auth()->user()->{$column}]);
    }

    /**
     * Show who completed the item and how long ago it was completed.
     *
     * @return $this
     */
    public function showDetails()
    {
        return $this->withMeta(['showDetails' => true]);
    }

    /**
     * Show how many items are completed of the total amount of items on index page.
     *
     * @return $this
     */
    public function showItemStatusOnIndex()
    {
        return $this->withMeta(['showItemStatus' => true]);
    }

    /**
     * Show how many percent of the items are completed on index page.
     *
     * @return $this
     */
    public function showCompletionOnIndex()
    {
        return $this->withMeta(['showCompletion' => true]);
    }

    /**
     * Allow add/edit/delete items.
     *
     * @param  Closure|bool  $callback
     * @return $this
     */
    public function canEdit($callback)
    {
        $canEdit = with(app(NovaRequest::class), function ($request) use ($callback) {
            return is_callable($callback) ? call_user_func($callback, $request) : ($callback === true);
        });

        return $this->withMeta(['canEdit' => $canEdit]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }
}
