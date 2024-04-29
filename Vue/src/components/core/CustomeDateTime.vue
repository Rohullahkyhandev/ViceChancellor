<template>
    <CustomDate />
</template>
<script>
import CustomDate from 'vue3-persian-datetime-picker'

export default {
    components: {
        CustomDate
    },
    props: {
        type: String,
    }

}
</script>
