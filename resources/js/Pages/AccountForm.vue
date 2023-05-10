<!-- modal de craição de conta de usuário usando o componentes de Vmodal -->
<template>
    <Vmodal v-model="showModal" title="Criar conta">
        <Vform ref="form" v-model="form" :rules="rules">
            <Vrow>
                <Vcol cols="12" md="6">
                    <Vtext-field v-model="form.name" label="Nome" :rules="rules.name"></Vtext-field>
                </Vcol>
                <Vcol cols="12" md="6">
                    <Vtext-field v-model="form.email" label="E-mail" :rules="rules.email"></Vtext-field>
                </Vcol>
                <Vcol cols="12" md="6">
                    <Vtext-field v-model="form.password" label="Senha" :rules="rules.password" type="password"></Vtext-field>
                </Vcol>
                <Vcol cols="12" md="6">
                    <Vtext-field v-model="form.password_confirmation" label="Confirmação de senha" :rules="passwordRules" type="password"></Vtext-field>
                </Vcol>
            </Vrow>
        </Vform>
        <template v-slot:footer>
            <Vbtn color="primary" @click="create">Criar</Vbtn>
            <Vbtn color="primary" @click="showModal = false">Cancelar</Vbtn>
        </template>
    </Vmodal>

    <Vsnackbar v-model="snackbar" :message="snackbarMessage" :color="snackbarColor" :timeout="snackbarTimeout" />
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            snackbar: false,
            snackbarMessage: '',
            snackbarColor: '',
            snackbarTimeout: 3000,

            rules: {
                name: [
                    v => !!v || 'Nome é obrigatório',
                    v => v.length <= 255 || 'Nome deve ter no máximo 255 caracteres',
                ],
                email: [
                    v => !!v || 'E-mail é obrigatório',
                    v => /.+@.+\..+/.test(v) || 'E-mail deve ser válido',
                ],
                password: [
                    v => !!v || 'Senha é obrigatória',
                    v => v.length >= 8 || 'Senha deve ter no mínimo 8 caracteres',
                ],
            },
            showModal: false,
        }
    },
    methods: {
        create() {
            let valid = this.$helpers.validateForm(this.login, rules)

            if (!valid != true) {
                this.snackbarMessage = valid
                this.snackbarColor = 'error'
                this.snackbar = true
            }
        },
    },
}
</script>