<template>
    <div>
        <div v-for="(child, index) in field.fields" :key="index">
            <component
                :is="'form-' + child.component"
                :resource-name="resourceName"
                :resource-id="resourceId"
                :field="child"
                :errors="errors"
                :related-resource-name="relatedResourceName"
                :related-resource-id="relatedResourceId"
                :via-resource="viaResource"
                :via-resource-id="viaResourceId"
                :via-relationship="viaRelationship"
            />
        </div>
    </div>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [ FormField, HandlesValidationErrors ],

        props: [
            'field',
            'resourceId',
            'viaResource',
            'resourceName',
            'viaResourceId',
            'viaRelationship',
            'relatedResourceId',
            'relatedResourceName'
        ],

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                for (const field of this.field.fields) {
                    field.fill(formData)
                }
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        }
    }

</script>
