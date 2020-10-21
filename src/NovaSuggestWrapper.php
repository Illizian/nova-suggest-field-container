<?php

namespace Illizian\NovaSuggestWrapper;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaSuggestWrapper extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-suggest-wrapper';

    /**
     * @var Collection
     */
    public $fields;

    /**
     * Create a new field.
     *
     * @param string|callable|null $attribute
     * @param array $fields
     */
    public function __construct(array $fields = [])
    {
        $this->withMeta(['fields' => $fields]);
    }

    /**
     * Resolve the field's value.
     *
     * @param mixed $resource
     * @param string|null $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        foreach ($this->meta['fields'] as $field) {
            $field->resolve($resource, $attribute);
        }
    }

    /**
     * Get the validation rules for this field.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function getRules(NovaRequest $request)
    {
        $rules = parent::getRules($request);

        foreach ($this->meta['fields'] as $field) {
            $rules = array_merge($rules, $field->getRules($request));
        }

        return $rules;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param NovaRequest $request
     * @param Model $model
     * @return mixed
     */
    public function fill(NovaRequest $request, $model)
    {
        foreach ($this->meta['fields'] as $field) {
            $field->fill($request, $model);
        }
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([ 'fields' => $this->meta['fields'] ], parent::jsonSerialize());
    }
}
