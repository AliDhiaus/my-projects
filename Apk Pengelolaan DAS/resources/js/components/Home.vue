<template>
    <div class="boxbody">

    </div>
    <aside-component></aside-component>
    <div class='content'>
        <Header v-if="showHeader" />
        <router-view></router-view>
    </div>
</template>

<script>
    import Header from './Header.vue';
    import Aside from './Aside.vue';
    export default {
      components: {
      Header,
      'aside-component': Aside,
    },
        computed: {
            showHeader() {
                return !this.$route.matched.some(record => record.meta.noHeader);
            }
        }
    }
</script>
