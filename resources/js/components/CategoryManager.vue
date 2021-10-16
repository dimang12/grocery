<template>
    <div class="row">
        <div class="col-12"  v-for="category in categories" :key="category.id">
            {{category.category_name}}
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'categories'
        ]
    }
</script>