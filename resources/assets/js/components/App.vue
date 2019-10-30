<template>
    <div class="container">
      <Header/>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <router-view></router-view>
            </div>
        </div>
        <Footer/>
    </div>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
export default {
    name: 'app',
    components: {Header, Footer}
}
</script>
