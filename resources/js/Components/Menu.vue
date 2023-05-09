<!-- component menu use boostsrap e vue-router -->
<template>
    <div class="navbar navbar-expand-lg bg-kight">
        <div class="container-fluid">
            <RouterLink class="navbar-brand" to="/">Home</RouterLink>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" :key="key" v-for="(item, key) in menu">
                        <RouterLink class="nav-link" :to="item.link">{{ item.name }}</RouterLink>
                    </li>
                </ul>
            </div>
            <Vbutton class="navbar-brand" type="button" color="primary" target="login" modal >
                Login
            </Vbutton>
        </div>
    </div>
    <Login id="login" title="<b>Login</b>"/>
</template>

<script>
    export default {
        data() {
            return {
                menu: [
                    { name: 'Home', link: '/' },
                    { name: 'About', link: '/about' },
                    { name: 'Contact', link: '/contact' },
                ],
                show: false
            }
        },
        watch: {
            show(e) {
                console.log(e)
            }
        },
        methods: {
            onConfirm() {
                // Handle the confirm action.
                this.showModal = false;
            },
            onCancel() {
                // Handle the cancel action.
                this.showModal = false;
            }
        }
    }
</script>