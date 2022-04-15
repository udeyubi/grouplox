<template>
    <div>
        <div class="px-5 py-4 mb-2 bg-light rounded-3">
            <div class="container-fluid py-5 mb-5">
                <h1 class="display-5 fw-bold">縮短您的網址</h1>
                <div class="input-group input-group-lg shadow-sm bg-body rounded">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="text" id="url" v-model="url" @input="checkIfValid()" class="form-control bg-secondary" style="--bs-bg-opacity: .1;" placeholder="試著輸入一個網址" autocomplete="off" tabindex="1" required>
                    <button class="btn btn-outline-secondary" type="submit" @click="getShortURL()" :disabled="gettingURL || !valid_url || error_msg">
                        <i class="bi bi-arrow-right" v-show="!gettingURL"></i>
                        <div class="spinner-border spinner-border-sm" role="status" v-show="gettingURL">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
                
                <span class="float-start fw-bold text-danger">{{ error_msg }}</span>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" style="display:none;" data-bs-toggle="modal" data-bs-target="#exampleModal" ref="showModalBtn"></button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg h-25">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">系統訊息</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <span class="fw-bold text-success mb-1 text-center">
                                {{copy_status ? '複製成功!':'準備完成 ! 複製後即可使用於任何地方 !'}}
                            </span>
                        </div>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" readonly :value="shorten_url" id="shortenURL">
                            <button class="btn btn-outline-secondary" type="button" id="copyButton" @click="copyURL()">
                                <i class="bi bi-clipboard" v-show="!copy_status"></i>
                                <i class="bi bi-check2" style="color: green;" v-show="copy_status"></i>
                            </button>
                        </div>
                        <div class="text-break">
                            原網址：<a class="text-primary" target="_blank" :href="origin_url">{{ origin_url }}</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-2 bg-light rounded-3">
                    <h2>使用紀錄</h2>
                    <ul class="list-group" style="max-height:202px;overflow-y:auto">
                        <li class="list-group-item" href="#" v-for="(url_history,index) in url_histories" :key="index">
                            <div class="d-inline-block text-truncate" style="max-width: 550px;">
                                <span class="text-primary fw-bold d-inline-block" style="min-width: 80px;"> {{url_history.id}} </span>
                                <span class="text-secondary"> {{url_history.url}} </span>
                            </div>
                            <a href="#" class="btn float-end btn-primary" @click="copyURL(url_history.id)">
                                <i class="bi bi-clipboard"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <h2>Add borders</h2>
                        <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
                        <button class="btn btn-outline-secondary" type="button">Example button</button>
                    </div>
            </div>
        </div>
    </div>
</template>


<script>
import Vue from 'vue';
    export default {
        props:['targetRoute','urlHistories'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                target_route:this.targetRoute,
                de_bug_url_histories:this.urlHistories,
                url_histories:this.urlHistories ? JSON.parse(this.urlHistories) : null,
                gettingURL:false,
                url:'',
                origin_url:null,
                shorten_url:null,
                copy_status:false,
                valid_url:false,
                error_msg:null,
            }
        },
        methods:{
            showModal(){
                this.$refs.showModalBtn.click();
            },
            getShortURL(){
                let self = this;
                this.gettingURL = true;
                axios.post(this.target_route,{url:this.url})
                     .then(function(response){
                         if(response.data){
                             if(response.data.success){
                                 self.shorten_url = response.data.success.shorten_url;
                                 self.origin_url = self.url;
                                 self.showModal();
                                 self.recordHistory( response.data.success );
                                 self.resetURLFunctionStatus();
                             }else if(response.data.error){
                                 self.error_msg = '無法縮短此網址';
                             }
                         }
                     })
                     .catch(function(error){
                         self.error_msg = error.response.data.errors.url[0];
                     })
                     .finally(function(){
                         self.gettingURL = false;
                     });

            },
            copyURL(short_url){
                let copyURLBtn = document.querySelector('#copyButton');

                if(!short_url){
                    let shortenURL = document.querySelector('#shortenURL');
                    console.log( this.copy_status );
                    shortenURL.select();
                    let copy_status = document.execCommand('copy');
                    copyURLBtn.focus();
                    this.copy_status = copy_status;
                }else{
                    let input_url = document.querySelector('#url');
                    let temp = input_url.value;
                    input_url.value = 'glxs.de/' + short_url;
                    input_url.select();
                    document.execCommand('copy');
                    input_url.value = temp;
                    input_url.blur();
                    alert('複製成功!');

                }
            },
            checkIfValid(){
                this.valid_url = false;

                if(this.url == ''){
                    return
                }
                if(this.url.length > 1000){
                    this.error_msg = '網址長度不可超過1000字';
                    return
                }
                this.error_msg = null;
                this.valid_url = true;
            },
            ruru(){

            },
            recordHistory(url_data){
                var data = { "id":url_data.id,"url":url_data.url };

                if( this.url_histories == null ){
                    this.url_histories = [data];
                }else{

                    this.url_histories.forEach( (element,key) =>{
                        if(element.id == data.id){
                            Vue.delete(this.url_histories,key);
                        }
                    });
                    this.url_histories.unshift(data);
                }
                
            },
            resetURLFunctionStatus(){
                this.url = null;
                this.error_msg = null;
                this.copy_status = false;
                this.valid_url = false;
            }
        },
        mounted(){
            this.checkIfValid();
        }
    }
</script>