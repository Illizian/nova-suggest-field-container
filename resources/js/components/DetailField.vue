<template>
    <div>
        <div v-for="(child, index) in field.fields" :key="index">
            <!-- <panel-item :field="child" /> -->

            <!-- panel-item does not allow us to override/extend the classes, so we've cloned it here instead -->
            <div
                class="flex border-b border-40 -mx-6 px-6"
                :class="{ 'remove-bottom-border': index == field.fields.length - 1 }"
            >
                <div class="w-1/4 py-4">
                    <slot>
                        <h4 class="font-normal text-80">{{ child.name }}</h4>
                    </slot>
                </div>
                <div class="w-3/4 py-4 break-words">
                    <slot name="value">
                        <p v-if="child.value" class="text-90">
                            {{ child.value }}
                        </p>
                        <p v-else>&mdash;</p>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        label() {
            return this.fieldName || this.field.name
        },

        fieldValue() {
            if (
                this.field.value === '' ||
                this.field.value === null ||
                this.field.value === undefined
            ) {
                return false
            }

            return String(this.field.value)
        },

        shouldDisplayAsHtml() {
            return this.field.asHtml
        },
    },
}
</script>
