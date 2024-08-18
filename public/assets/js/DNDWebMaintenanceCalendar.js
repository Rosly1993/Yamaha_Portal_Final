function GetCalendarData() {

    axios.get("mtn_controller?action=GetCalendarData").then((server) => {
        var CalendarData = server.data.CalendarData;
        console.log(CalendarData);
        var AllEvents = [];

        for (var i = 0; i < CalendarData.length; i++) {
            var eventData = {
                title: CalendarData[i]["Title"],
                start: CalendarData[i]["Start Date"],
                end: CalendarData[i]["End Date"],
                extendedProps: {
                    IndexKey: CalendarData[i]["IndexKey"],
                    location: CalendarData[i]["Location"],
                    description: CalendarData[i]["Description"],
                    starttime: CalendarData[i]["Start Datetime"],
                    endtime: CalendarData[i]["End Datetime"],
                }
            };
            AllEvents.push(eventData);
        }

        var calendar = new FullCalendar.Calendar($('#DNDWebMaintenanceCalendar')[0], {
            initialView: 'dayGridMonth',
            views: {
                week: {
                    type: 'dayGridWeek',
                    duration: { weeks: 1 },
                    buttonText: 'Week'
                },
                day: {
                    type: 'dayGridDay',
                    duration: { days: 1 },
                    buttonText: 'Day'
                },
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,week,day'
            },
            events: AllEvents,
            eventClick: function (info) {
                // Display the full title in an alert
                $("#selectedevent").html(info.event.title);
                $("#ViewCalendarEventDetailsModal").modal('show');
                $(".txt-eventtitle").val(info.event.title);
                $(".txt-eventdescription").val(info.event.extendedProps.description);
                $(".txt-eventlocation").val(info.event.extendedProps.location);
                $(".txt-startdate").val(info.event.extendedProps.starttime.replace(' ', 'T'));
                $(".txt-enddate").val(info.event.extendedProps.endtime.replace(' ', 'T'));
                $(".txt-HiddenIndexKey").val(info.event.extendedProps.IndexKey);
            }
        });

        calendar.render();
        // console.log(calendar);
    })

}

function DeleteCalendarData(IndexKey) {
    Swal.fire({
        title: "Are you sure you want to delete this event?",
        icon: "question",
        showCancelButton: true,
    }).then((swalaction) => {
        if (swalaction.isConfirmed) {
            axios.post("mtn_controller?action=DeleteCalendarData", {
                IndexKey: IndexKey
            }).then((server) => {
                Swal.fire({
                    title: server.data.title,
                    icon: server.data.icon,
                }).then(() => {
                    GetCalendarData();
                })
            })
            $("#ViewCalendarEventDetailsModal").modal('hide');
        }
    })
}

function UpdateCalendarData(postdata) {
    Swal.fire({
        title: "Are you sure you want to update this event?",
        icon: "question",
        showCancelButton: true,
    }).then((swalaction) => {
        if (swalaction.isConfirmed) {
            axios.post("mtn_controller?action=UpdateCalendarData", {
                PostData: postdata,
            }).then((server) => {
                console.log(server.data);
                Swal.fire({
                    title: server.data.title,
                    icon: server.data.icon,
                }).then(() => {
                    GetCalendarData();
                })
            })
            $("#ViewCalendarEventDetailsModal").modal('hide');
        }
    })
}