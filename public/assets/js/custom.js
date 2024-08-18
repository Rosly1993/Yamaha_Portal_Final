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