
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
        posts:[],
        postid:"",
        newComment:"",
        comments:[],
        likeValue:0,
        postlikeid:""
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
                this.posts.unshift({id:response.data.id,text:response.data.text,created_at:response.data.created_at,path:response.data.file.path});
                this.$forceUpdate();
            });
        },
        sendComment:function ($userid,$postid) {
            this.postid = $postid;
            axios.post('/profile/comment/'+$postid,{
                userid:$userid,
                text:this.newComment
            }).then(response=>{
                this.comments.push({text:response.data.text,name:response.data.user.name,post_id:response.data.post_id});
                location.reload();
            });

        },
        like:function ($postid,$userid,e) {
            var value = Number(e.target.innerText);
            e.target.innerText = value+=1;

            axios.post('/profile/like/'+$postid,{
                userid : $userid,
                vote: e.target.innerText
            })


        }

    }
});

