<template>
    <div id="vue-backend-app">
        <router-view></router-view>
    </div>
</template>

<script>
import TabNavigation from './components/tabs/Navigation.vue'
export default {
    name: 'App',
    components: {
        'tab-navigation': TabNavigation
    }
}
</script>

<style>

</style>