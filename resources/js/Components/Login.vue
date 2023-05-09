<template>
    <Bmodal @close="close()" :id="id" :title="title" noFooter>
        <Vform @submit.prevent="onSubmit">
            <Vrow>
                <Vcol>
                    <Vinput v-model="login.email" type="text" name="email" label="Email" :rules="emailRules"/>
                </Vcol>
            </Vrow>
            <Vrow>
                <Vcol>
                    <Vinput v-model="login.password" type="password" name="password" label="Password" :rules="passwordRules"/>
                </Vcol>
            </Vrow>
            <Vrow>
                <Vcol>
                    <Vbutton type="submit" color="primary">Login</Vbutton>
                </Vcol>
            </Vrow> 
        </Vform>
    </Bmodal>

    <Vsnackbar v-model="snackbar" :message="snackbarMessage" :color="snackbarColor" :timeout="snackbarTimeout" />
</template>

<script>
import Vsnackbar from './Vsnackbar.vue'
    export default {
	components: { Vsnackbar },
        props: {
            id: {
                type: String,
                default: 'login'
            },
            title: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                login: {
                    email: null,
                    password: null
                },
                snackbar: false,
                snackbarMessage: '',
                snackbarColor: '',
                snackbarTimeout: 3000

            }
        },
        computed: {
            emailRules(){
                return [
                    v => !!v || 'E-mail é obrigatório',
                    v => /.+@.+\..+/.test(v) || 'E-mail deve ser válido',
                ]
            },
            passwordRules() {
                return [
                    v => !!v || 'Senha é obrigatória',
                ]
            },
        },
        methods: {
            onSubmit(e) {

                let valid = this.$helpers.validateForm(this.login, {email: this.emailRules, password:this.passwordRules})

                if(valid != true) {
                    this.snackbarMessage = valid
                    this.snackbarColor = 'error'
                    this.snackbar = true
                    return
                }

                let login = {
                    ...this.login,
                    password: this.$helpers.hash(this.login.password)
                }

                this.$api.post(this.$helpers.route('api.user.login'), login).then(res => {
                    console.log(res)    
                }).catch(err => {
                    this.snackbarMessage = err
                    this.snackbarColor = 'error'
                    this.snackbar = true
                })
            },
            
            close() {
                this.login = {
                    email: null,
                    password: null
                }
            },
            
        }

    }
</script>