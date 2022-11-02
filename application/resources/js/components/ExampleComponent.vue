<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            I'm an example component.
            <slot></slot>
            <h2>{{ testprop }}</h2>
            <button @click="show()">click</button>
            <button @click="emittest()">emit</button>
          </div>
          <ul>
              <li v-for="(user, index) in users" :key="index">
                  {{ user.name }}
              </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  props: ["testprop"],
  data(){
     return{
          users: null
     }
  },
  methods: {
    show() {
      this.emitter.emit("relay", "ok");
    },
    emittest(){
        this.$emit('testing', 'ok')
    }
  },
  mounted() {
      var that = this
      axios.get('/testaxios')
        .then(function(response){
                let data =  response.data.filter(function(data){
                   return data.id ==1
                })
                that.users = (data);
        })
  },
};
</script>
