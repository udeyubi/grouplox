<template>
    <div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" v-model="status" v-on:change="changeStatus()">
            <label class="form-check-label">{{ status_description }}</label>
        </div>

        <transition name="fade">
            <div class="alert alert-primary position-absolute top-50 start-50 translate-middle" v-if="this.show_message">
                {{ message }}
            </div>
        </transition>
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>

<script>
    export default {
        props:['apiStatusName','apiStatus','apiStatusDescription'],
        data(){
            return{
                show_message:false,
                status_name:this.apiStatusName,
                status:this.apiStatus,
                status_description:this.apiStatusDescription,
                message:null
            }
        },
        methods:{
            changeStatus(){
                let self = this;
                axios.patch("apistatus/"+ this.status_name,{status:this.status})
                .then(function (response) {
                    if(response.data){
                        let temp_msg = null;
                        if( self.status_name == 'service' ){
                            temp_msg = self.status ? '服務已啟用，可正常請求API' : '服務已關閉，外部網站將無法使用API';
                        }
                        else if( self.status_name == 'validate' ){
                            temp_msg = self.status ? '驗證已開啟，請求API需要token' : '驗證已關閉，任何人皆可請求API';
                        }
                        self.message = temp_msg;
                        self.showMessage();
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
            },
            showMessage(){
                let self = this;
                self.show_message = true;
                setTimeout(function(){
                    self.show_message = false;
                },3000);
            }
        },
        mounted(){
        }
    }
</script>