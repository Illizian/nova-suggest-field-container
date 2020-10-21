<template>
    <div>
        <div v-for="(child, index) in field.fields" :key="index">
            <at-ta
                :at="trigger"
                :members="suggestions"
            >
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
                    show-help-text="true"
                />
            </at-ta>
        </div>
    </div>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'
    import AtTa from 'vue-at/dist/vue-at-textarea'

    export default {
        components: {
            AtTa
        },

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

        computed: {
            trigger() {
                return this.field.trigger || ':';
            },
            suggestions() {
                return this.field.suggestions || [];
            }
        },

        methods: {
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                for (const field of this.field.fields) {
                    field.fill(formData)
                }
            },
        },
    }

</script>
