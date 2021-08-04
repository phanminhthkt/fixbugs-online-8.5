<template>
    <div class="col-12">
        <Transition name="slide-fade">
        <div id="alert-container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errorList">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <ul>
                    <li v-for="(errorName, index) in errorList.errors" :key="index">
                        <i class="mdi mdi-block-helper mr-1"></i>{{ errorName[0] }}
                    </li>
                </ul>
            </div>

            <div 
                v-if="message"
                :class="{
                  'alert alert-danger alert-dismissible fade show': message.type === 'danger',
                  'alert alert-success alert-dismissible fade show': message.type === 'success',
                  'alert alert-warning alert-dismissible fade show': message.type === 'warning'
                }"
                role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i 
                    :class="{
                      'mdi mdi-block-helper mr-1': message.type === 'danger',
                      'mdi mdi-check  mr-1': message.type === 'success',
                      'mdi mdi-alert-outline fade show mr-1': message.type === 'warning'
                    }"
                    class="mdi mdi-block-helper ">
                    
                </i>
                {{ message.text }}
            </div>
        </div> 
        </Transition>   
    </div>    
</template>

<script>
    export default {
      data() {
        return {
          message: null,
          errorList: null
        };
      },
      mounted() {
        let timer;
        this.$bus.on('flash-message', message => {
            clearTimeout(timer);
            this.message = message;
            timer = setTimeout(() => {
                this.message = null;
              }, 5000);
        });
        this.$bus.on('flash-messages', errorList => {
            clearTimeout(timer);
            this.errorList = errorList;
            timer = setTimeout(() => {
        this.message = null;
      }, 5000);
        });
      
      }
    };
</script>
<style scoped>
    .slide-fade-enter-active,
    .slide-fade-leave-active {
      transition: all 0.4s;
    }
    .slide-fade-enter,
    .slide-fade-leave-to {
      transform: translateY(100px);
      opacity: 0;
    }
</style>