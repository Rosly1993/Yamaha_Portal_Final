var BadgeApp = new Vue({
    el: '.UserBadgeList',
    data: {
        UserBadges: [],
        Session: [],
    },
    methods: {
        GetUserBadge: function () {
            axios.get("mtn_controller?action=GetUserBadge").then((server) => {
                console.log(server.data);
                BadgeApp.UserBadges = server.data.AllBadges;
                BadgeApp.Session = server.data.Session;
            })
        }
    },
    mounted() {
        this.GetUserBadge();
    }
})



function SwalWait(t) {
    Swal.fire({
        title: t,
        allowEscapeKey: false,
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        }
    });
}

function SwalSuccess(t, m) {
    Swal.fire({
        title: t,
        text: m,
        icon: 'success',
    });
}

function SwalError(t, m) {
    Swal.fire({
        title: t,
        text: m,
        icon: 'error',
    });
}

function SwalClose() {
    Swal.close();
}