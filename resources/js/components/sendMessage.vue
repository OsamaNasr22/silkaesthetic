<template>
</template>

<script>
    export default {
        data(){
          return {
              name:'Name',
              phone:'Phone',
              sender:'E-mail',
              message: '',
          }  ;
        },


        //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        methods:{
            sendMail(){
                fetch('/sendMail',{
                    method:'post',
                    body: {},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(function (res) {
                    console.log(res)
                }).catch(error => {
                    console.log(error);
                });




            }



        }
    }
</script>
