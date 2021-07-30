<template>
    <div class="my-component">
        <div>Message type: {{ message.type }}</div>
        <div>Message text: {{ message.text }}</div>
        <div><button >Change type</button></div>
        <div><button >Change text</button></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            	message: {
            		type: 'greeting',
            		text: 'How are you?'
            	}
            }
        },
        
        computed: {
            getType() {
                return this.message.type
            },
            getText() {
                return this.message.text
            }
        },
        watch: {
            getType() {
            	console.log('type changed')
            },
            getText() {
            	console.log('text changed')
            }
        }
    }
</script>

<style lang="scss" scoped>
    .my-component {
        color: red;
    }
</style>