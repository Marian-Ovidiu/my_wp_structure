# Skill: ACF Model Pattern

## Purpose

This skill explains the ACF model pattern used in this repository and how to extend it safely.
It covers:

- `Core\Bases\BaseGroupAcf`
- `Core\Bases\BasePostType`
- `Core\FieldAcf`

## `BaseGroupAcf`

`BaseGroupAcf` is the base abstraction for ACF group-backed models.

Responsibilities:

- Hold the ACF group identifier and target post/context (`$postId`, default often `option`).
- Register fields through `addField('field_name')`.
- Load field values through `setFields()` via `get_field(...)`.
- Expose loaded values as model properties.

Typical model usage pattern:

1. Extend `BaseGroupAcf`.
2. Define a constructor with `parent::__construct(<group-key>, <post-id>)`.
3. Register fields in `defineAttributes()`.
4. Optionally add computed accessors (`getXAttribute`) for derived structures.

## `BasePostType`

`BasePostType` is the base model for post-type entities.

Responsibilities:

- Map core post properties (`id`, `title`, `content`, `featured_image`, `url`).
- Provide query helpers (`all`, `find`, `where`, `mapPosts`).
- Delegate custom field mapping to `defineOtherAttributes($post)`.

Use this for content models tied to a `post_type` (for example `Progetto`), especially when combining WP core fields with ACF fields.

## `FieldAcf`

`FieldAcf` is a small field wrapper object used by `BaseGroupAcf`.

Responsibilities:

- Store field key/name/label/type/value metadata.
- Provide fluent setters/getters.
- Normalize label from slug-like keys.

In practice, each `addField(...)` call creates a `FieldAcf` instance that is later populated by `setFields()`.

## How Models Represent ACF Groups

An ACF group model usually:

- Declares public properties for expected fields.
- Calls `addField` for each field key.
- Uses `BaseGroupAcf::get($postId)` to instantiate and hydrate values.

This gives templates/controllers a typed-ish object instead of repeated raw `get_field(...)` calls.

## How Fields Are Registered

Fields are registered in model methods (commonly `defineAttributes()`), not inside controllers.
Example pattern:

- constructor sets group key and target post/options context;
- `defineAttributes()` registers all keys with `addField`.

Hydration occurs when `setFields()` runs (usually via static `get(...)` helper).

## Example: Create a New ACF Group Model

```php
<?php

namespace Models\Options;

use Core\Bases\BaseGroupAcf;

class NewsletterOptionsFields extends BaseGroupAcf
{
    protected $groupKey = 'group_1234567890abc';

    public $title;
    public $subtitle;
    public $cta_label;

    public function __construct($postId = null)
    {
        parent::__construct($this->groupKey, $postId ?? 'option');
        $this->defineAttributes();
    }

    public function defineAttributes()
    {
        $this->addField('title');
        $this->addField('subtitle');
        $this->addField('cta_label');
    }
}
```

Usage example:

```php
$options = \Models\Options\NewsletterOptionsFields::get('option');
echo $options->title;
```

## Example: Create a New Post Type Model with ACF

```php
<?php

namespace Models;

use Core\Bases\BasePostType;

class Evento extends BasePostType
{
    public static $postType = 'evento';

    public $date;
    public $location;

    public function defineOtherAttributes($post)
    {
        $this->date = get_field('date', $this->id);
        $this->location = get_field('location', $this->id);
    }
}
```

## Common Mistakes to Avoid

- Hardcoding option pages everywhere instead of centralizing context in model constructors.
- Placing ACF configuration/field registration inside controllers.
- Mixing business logic with field definitions in ACF model setup methods.

Keep ACF models focused on schema mapping and value hydration; keep business decisions in Feature/Project logic layers.
