<?php

namespace Ahmedkandel\NovaChecklist;

use Laravel\Nova\Fields\Field;

class Checklist extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-checklist';

    public function placeholder($text)
    {
        return $this->withMeta(['placeholder' => $text]);
    }

    public function placeholderCounter()
    {
        return $this->withMeta(['placeholderCounter' => true]);
    }

    public function storeUserName($column = 'name')
    {
        return $this->withMeta(['user' => auth()->user()->{$column}]);
    }

    public function showDetails()
    {
        return $this->withMeta(['showDetails' => true]);
    }

    public function showItemStatusOnIndex()
    {
        return $this->withMeta(['showItemStatus' => true]);
    }

    public function showCompletionOnIndex()
    {
        return $this->withMeta(['showCompletion' => true]);
    }
}
