<template>
    <navbar-component></navbar-component>
    <div class='content'>
            <Header v-if="showHeader" />
            <router-view></router-view>
    </div>
</template>

<script>
    import Header from './Header.vue';
    import navbar from './navbar.vue';
    export default {
    components: {
        Header,
        'navbar-component': navbar,
    },
        computed: {
            showHeader() {
                return !this.$route.matched.some(record => record.meta.noHeader);
            }
        }
    }
</script>
