<template>
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Notifications"><i class="fa fa-bell" aria-hidden="true"></i> <span v-if="unreadNotifications.length" class="badge blue">{{unreadNotifications.length}}</span></a>
</template>

<script>
    export default {
        props:['unreads','id'],
        data(){
          return{
            unreadNotifications:this.unreads
          }
        },
        mounted() {
            console.log('Component mounted.')
            window.Echo.private('App.User.'+this.id)
                .notification((notification) => {
                let newUnreadNotifications = {data: {booker_avatar: notification.booker_avatar, booker_name: notification.booker_name, booking_id: notification.booking_id, dept_name: notification.dept_name, id: notification.id, type: notification.type}};
                this.unreadNotifications.push(newUnreadNotifications);
                });
        }
    }
</script>
