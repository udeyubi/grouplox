<template>
    <transition>
        <div class="alert alert-success position-fixed top-0 start-50 translate-middle-x" style="min-width:150px" v-show="show_message" role="alert">
            <div class="d-flex justify-content-between">
                <div class="mx-2">
                    {{ message }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </transition>
</template>

<style>
    .v-enter-active, .v-leave-active {
        transition: opacity 1s;
    }

    .v-enter-from, .v-leave-to {
        opacity: 0;
    }

    .v-enter-to, .v-leave-from {
        opacity: 1;
    }
</style>

<script>
    export default {
        props:['successMsg'],
        data(){
            return{
                show_message:true,
                message:this.successMsg,
                show_timeout:4000
            }
        },
        methods:{
        },
        mounted(){
            var self = this;
            setTimeout(function(){
                self.show_message = false;
            },self.show_timeout);
        }
    }
</script>