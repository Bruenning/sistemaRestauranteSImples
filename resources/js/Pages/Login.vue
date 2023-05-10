<template>
    <Bmodal @close="close()" id="login" :title="title" noFooter :show="showModal">
        <Vform>
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
                    <Vbutton type="submit" color="primary" @click="onSubmit">Login</Vbutton>
                    <a href="#" @click="createAccont()">Criar Conta</a>
                </Vcol>
            </Vrow> 
        </Vform>
    </Bmodal>

    <Vsnackbar v-model="snackbar" :message="snackbarMessage" :color="snackbarColor" :timeout="snackbarTimeout" />

    <AccountForm v-if="showAccount" :show="showAccount" @close="closeAccount()" />
</template>

<script>
    export default {
    emits: ["close"],
    props: {
        title: {
            type: String,
            default: ""
        },
        show: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            login: {
                email: null,
                password: null
            },
            snackbar: false,
            snackbarMessage: "",
            snackbarColor: "",
            snackbarTimeout: 3000,
            showModal: false,
            showAccount: false,
        };
    },
    mounted() {
        this.reload();
    },
    watch: {
        "show": function () {
            this.showModal = this.show;
        },
    },
    computed: {
        emailRules() {
            return [
                v => !!v || "E-mail é obrigatório",
                v => /.+@.+\..+/.test(v) || "E-mail deve ser válido",
            ];
        },
        passwordRules() {
            return [
                v => !!v || "Senha é obrigatória",
            ];
        },
    },
    methods: {
        onSubmit(e) {
            let valid = this.$helpers.validateForm(this.login, { email: this.emailRules, password: this.passwordRules });

            if (valid != true) {
                this.snackbarMessage = valid;
                this.snackbarColor = "error";
                this.snackbar = true;
                return;
            }

            let login = {
                ...this.login,
                password: this.$helpers.hash(this.login.password)
            };

            this.$api.post("user/login", login).then(res => {
                this.snackbarMessage = "Login efetuado com sucesso!";
                this.snackbarColor = "success";
                this.snackbar = true;

                localStorage.setItem("token", res.data.token);
                localStorage.setItem("user_id", res.data.user_id);

                this.reload(true);

            }).catch(err => {
                this.snackbarMessage = err;
                this.snackbarColor = "error";
                this.snackbar = true;
            });
        },

        createAccont() {
            this.preventDefault();

            this.showAccount = true;
        },

        closeAccount() {
            this.showAccount = false;
        },
        
        reload(reload = false) {
            if (localStorage.getItem("token")) {
                this.$router.push({ name: "Home" });
                this.close();
            }
            if (reload) {
                window.location.reload();
            }
        },
        close() {
            this.login = {
                email: null,
                password: null
            };
        },
    },
}
</script>