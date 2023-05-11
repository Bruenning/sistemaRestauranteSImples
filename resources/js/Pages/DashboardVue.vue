<template>
    <Vcontainer class="dashboard">
        <Vrow>
            <Vcol cols="12">
                <div class="d-flex justify-content-between">
                    <h1>Reservas</h1>
                    <Vbutton v-if="!$isAdmin" @click="CreateReservation" color="primary">Nova reserva</Vbutton>
                </div>
            </Vcol>
            <Vcol>
                <Btable :headers="headers" :items="items">
                </Btable>
            </Vcol>
        </Vrow>
    </Vcontainer>

    <Reservation :show="showReservation" @close="close()" @snack="ShowSnackbar"></Reservation> 

    <Vsnackbar v-model="snackbar" :message="snackbarMessage" :color="snackbarColor" :timeout="snackbarTimeout" />
</template>

<script>
import Vrow from '@/Components/Vrow.vue'
export default {
	components: { Vrow },
    data() {
        return {
            headers: [
                {title: 'Reservado por', key: 'user', cols: null},
                {title: 'Data', key: 'date', cols: null},
                {title: 'Horário', key: 'time', cols: null},
            ],
            items: [],
            showReservation: false,

            snackbar: false,
            snackbarMessage: "",
            snackbarColor: "",
            snackbarTimeout: 3000,

        }
    },
    mounted() {
        this.reload()
    },
    methods: {
        reload() {
            this.items = []
            this.$api.get(`user/show/${window.localStorage.getItem('user_id')}`).then(response => {
                if (this.$isAdmin == 1) {
                    this.$api.get('reservations/index').then(r => {
                        r.data.data.forEach(element => {
                            this.items.push({
                                id: element.id,
                                user: element.user.name,
                                date: this.$helpers.getDate(element.dateReservation),
                                time: this.$helpers.getTime(element.timeReservation),
                            })
                        });
                    })
                    return
                }

                this.$api.get(`reservations/user/${response.data.data.id}`).then(r => {
                    r.data.data.forEach(element => {
                        this.items.push({
                            id: element.id,
                            user: element.user.name,
                            date: this.$helpers.getDate(element.dateReservation),
                            time: this.$helpers.getTime(element.timeReservation),
                        })
                    });
                })
            })  
        },
        edit(id) {
            this.$router.push({ name: 'user.edit', params: { id: id } })
        },
        remove(id) {
            this.$dialog
                .confirm('Tem certeza que deseja remover este usuário?')
                .then(dialog => {
                    this.$api.delete('/api/users/' + id).then(response => {
                        this.reload()
                        this.$dialog.alert('Usuário removido com sucesso!')
                    })
                })
        },

        CreateReservation() {
            this.showReservation = true
        },

        close() {
            this.showReservation = false
            this.reload()
        },

        ShowSnackbar(e) {
            this.snackbar = true
            this.snackbarMessage = e.message
            this.snackbarColor = e.color
        },
    },
}
</script>