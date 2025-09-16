<!-- src/views/Dashboard.vue -->
<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="6">
        <reservations-table :reservations="reservations" />
      </v-col>
      
    </v-row>
    <v-row>
      <v-col cols="12">
        <notifications :notifications="notifications" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ReservationsTable from '@/components/ReservationsTable.vue'
import Notifications from '@/components/Notifications.vue'
import { ref, onMounted } from 'vue'
import { io } from 'socket.io-client'

export default {
  components: { ReservationsTable, Notifications },
  setup() {
    const reservations = ref([])
    const passengers = ref([])
    const notifications = ref([])


    fetch('http://localhost:8000/api/reservations').then((response) => 
		{
			response.json().then((jsonResponse) => {
				reservations.value = jsonResponse.data
			})
		})	

    const socket = io('http://localhost:3001') // servidor Node.js


    socket.on('reservation.updated', event => {

      const {id, status, flight_number } = event.data.data
      console.info(event.data.data)

      notifications.value.push({message: `Reserva modificada: ${flight_number} cambio a ${status}`, time: new Date()})

      const refreshReservations = reservations.value.map(row => {
        if(row.id == id) {
           row.status = status 
        }
         
        return row;

      })

      reservations.value = refreshReservations;

    })

    // Suscribirse a eventos en tiempo real
    //socket.on('reservations', data => reservations.value = data)
    //socket.on('passengers', data => passengers.value = data)
    //socket.on('notifications', data => notifications.value.unshift(data))

    return { reservations, passengers, notifications }
  },
  
  onMounted () {
	  

		
		
  }
}
</script>
