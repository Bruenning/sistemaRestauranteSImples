<template>
    <Bmodal @close="close()" id="Reservation" :title="title" noFooter :show="showModal">
        <Vform>
            <Vrow>
                <Vcol cols="12">
                    <VueDatePicker v-model="teste" :enable-time-picker="false" :allowed-dates="allowedDates" auto-apply position="left" ></VueDatePicker>
                </Vcol>
                <Vcol cols="12" >
                    <Vselect :items="items" :label="label" :rules="rules" ></Vselect>
                </Vcol>
            </Vrow>
        </Vform>
    </Bmodal>
</template>

<script>

export default {

    data() {
        return {
            picker: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            items: [
                {id: 1800, name: '18:00'},
                {id: 1830, name: '18:30'},
                {id: 1900, name: '19:00'},
                {id: 1930, name: '19:30'},
                {id: 2000, name: '20:00'},
                {id: 2030, name: '20:30'},
                {id: 2100, name: '21:00'},
                {id: 2130, name: '21:30'},
                {id: 2200, name: '22:00'},
                {id: 2230, name: '22:30'},
                {id: 2300, name: '23:00'},
                {id: 2330, name: '23:30'},
            ],
            teste:  new Date(),
            label: 'Select Item',
            rules: [
                value => !!value || 'Item is required',
            ],
        }
    },
    computed:{
        allowedDates () {
            let date = new Date()
            let dates = []

            date.setDate(date.getDate() + 1)

            while (date.getDate() <= 30) {
                if (date.getDay() != 1)
                    dates.push(date.toISOString().substr(0, 10))

                date.setDate(date.getDate() + 1)
                
            }
           
            return dates

        },
    }
}
</script>
