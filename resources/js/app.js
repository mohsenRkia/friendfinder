
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const profile = new Vue({
    el: '#profile',
    data:{
        textPost:"",
        userid:[],
        posts:[]
    },
    methods:{
        addFriend:function($friendId,$currentUserId,e){
          axios.post('/profile/follow/'+$friendId,{
              currentUserId : $currentUserId,
          }).then(response => {
          if (response.data === 1){
              e.target.innerHTML = "Followed";
              e.target.className = "btn btn-success";
          }else if(response.data === 0){
              e.target.innerHTML = "Add Friend";
              e.target.className = "btn btn-primary";
          }

          });

        },
        sendPost:function ($id) {
            var data = new FormData();
            var file = this.$refs.imagePost.files[0];
            data.append('image',file);
            data.append('text',this.textPost);
            axios.post('/profile/sendpost/'+$id,data).then(response=>{
                this.posts.unshift({text:response.data.text,created_at:response.data.created_at,path:response.data.file.path});
                this.$forceUpdate();
            });
            //this.$refs.imagePost.files[0]
        },
        getPosts:function ($id) {
            alert($id);
            //axios.post(path,{
//
            //}).then(response => {
            //    this.posts = response.data;
            //});
        }

    }
});

