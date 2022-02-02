# Laravel Nova Checklist Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahmedkandel/nova-checklist.svg)](https://packagist.org/packages/ahmedkandel/nova-checklist)
[![License](https://img.shields.io/packagist/l/ahmedkandel/nova-checklist.svg)](https://packagist.org/packages/ahmedkandel/nova-checklist)
[![Total Downloads](https://img.shields.io/packagist/dt/ahmedkandel/nova-checklist.svg)](https://packagist.org/packages/ahmedkandel/nova-checklist)

Based on [encima-io/novachecklists](https://github.com/encima-io/novachecklists)

This package is made to allow you to easily create checklists in Laravel Nova. All you need is a text/json column on you model to store the items.

## Installation

You can install the package via composer:

```bash
composer require ahmedkandel/nova-checklist
```

## Usage

```php
use Ahmedkandel\NovaChecklist\Checklist;

Checklist::make('Tasks')
    ->placeholder('Add another task')   // Defaults to "Add item"
    ->placeholderCounter()              // Not active by default
    ->storeUserName()                   // Not active by default, accepts user-model column. Uses "name" when column isn't provided.
    ->showDetails()                     // Not active by default
    ->showItemStatusOnIndex()           // Not active by default
    ->showCompletionOnIndex(),          // Not active by default
```

To use this package you'll need a text or JSON column on you model to save the items/tasks, as they are persisted as json on your model.

### Form-page
The `->placeholder()` method allows you to specify your placeholder-text for the "add new item field".

The `->placeholderCounter()` method lets you show the item number when adding new item. If there is already 5 items, then it will say "Add item 6".

The `->storeUserName()` method allows you to save which user created or completed the task/item. You specify which column on the User model you want to save on task, it default to use the "name" column.

![Checklist-form-page](https://raw.githubusercontent.com/ahmedkandel/nova-checklist/master/form-add.png)

You can edit an existing item by clicking on it.

![Checklist-form-page](https://raw.githubusercontent.com/ahmedkandel/nova-checklist/master/form-edit.png)

### Detail-page

The `->showDetails()` method lets you show who completed the task/item and how long ago it was completed.

![Checklist-detail-page](https://raw.githubusercontent.com/ahmedkandel/nova-checklist/master/detail.png)

### Index-page
By default this package will only show the task count on the index page.

The `->showItemStatusOnIndex()` will change the index to show how many tasks are completed of the total amount of tasks/items.

The `->showCompletionOnIndex()` method will let you show how many percent of the tasks are completed.

![Checklist-detail-page](https://raw.githubusercontent.com/ahmedkandel/nova-checklist/master/index.png)

## License

The MIT License (MIT).
