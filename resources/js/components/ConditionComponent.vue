<template>
	<div class="conditional-rendering">
        <div class="block-1" v-show="isActive == true" >
            This is block 1
        </div>
        <div class="block-2" v-show="isActive == false">
            This is block 2
        </div>
        <div>
            <button @click="isActive = !isActive">Button</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: true
            }
        }
    }
</script>

<style lang="scss" scoped>
	
</style>