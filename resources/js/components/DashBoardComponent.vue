<template>
    <div id="main">
        <Header :user="user"></Header>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>    
        <Footer></Footer>
    </div>    
</template>

<script>
    import Header from './HeaderComponent.vue'
    import Footer from './FooterComponent.vue'
    export default {
        props:['user'],
        data() {
            return{
                
            }
        },
        components: {
            Header,
            Footer
        }
    }
</script>