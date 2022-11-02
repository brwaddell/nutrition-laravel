<template>
  <h2>test</h2>
    <!-- <ex @testing="testemit"></ex> -->

    <router-link :to="{ name: 'home'}">User</router-link>
    <router-link :to="{ name: 'test'}">test</router-link>

    <router-view></router-view>
</template>

<script>
import ex from './ExampleComponent.vue'
export default {
    data(){
        return{
            emitdata:''
        }
    },
    components:{
        ex
    },
    methods:{
        testemit(v){
            console.log(v);
        }
    },
    mounted(){
        this.emitter.on("relay", isOpen => {
            console.log(isOpen);
    });

    },

};
</script>

<style>
</style>
