$(document).ready(function() {

    $(document).foundation();
    
    // hide timepicker when out of focus
//    $("*:not(.timepicker)").click(function(){
//        $(".timepicker").timepicker("hideWidget");
//    });

    // calendar
    $('#calendar').fullCalendar({
        weekends: false, // will hide Saturdays and Sundays
        editable: false,
        events: [
            {
                title: 'All Day Event',
                start: '2014-01-01'
            },
            {
                title: 'Long Event',
                start: '2014-01-07',
                end: '2014-01-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2014-01-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2014-01-16T16:00:00'
            },
            {
                title: 'Meeting',
                start: '2014-01-12T10:30:00',
                end: '2014-01-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2014-01-12T12:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2014-01-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2014-01-28'
            }
        ]
    });

    // Timepicler
    $(".timepicker").timepicker().on('show.timepicker', function(e) {
        $(".timepicker").not(this).timepicker('hideWidget');
    });

    // delete link for schedule time
    $(".timeschedule-delete").click(function() {
        var slot = $(this).data("schedulefield");
        var section = $(this).data("section");

        // get how many fields there are
        var timeSlots = $(".course-schedule").length

        // only remove when its more than one time slot
        if (timeSlots > 1)
            $("select[name='data[" + section + "][schedule][" + slot + "][day]']").parent().remove();
        else
            alert("You need to have atleast one time slot that your course meets!");

        // turn on foundation on the page
        $(document).foundation();
    });
    // add new timeschedule times
    $("#addNewTimescheduleField").click(function() {

        // get how many fields there are
        var timeSlots = $(".course-schedule").length;
        var newSlot = timeSlots;
        var section = $(this).data("section");

        // Append new slot to the times offered section
        var daysOfTheWeek = [{
                id: 1,
                day: "Sunday"
            },
            {
                id: 2,
                day: "Monday"
            },
            {
                id: 3,
                day: "Tuesday"
            },
            {
                id: 4,
                day: "Wednesday"
            },
            {
                id: 5,
                day: "Thursday"
            },
            {
                id: 6,
                day: "Friday"
            },
            {
                id: 7,
                day: "Saturday"
            }]; //["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        var courseScheduleDiv = $("<div class='course-schedule' />");
        var daysSelectField = $("<select class='columns large-4 left' name='data[" + section + "][schedule][" + newSlot + "][day]' required><option value=\"\">-- Select Day --</option></select>");
        var startTimeField = $("<input class='timepicker left' type='text' name='data[" + section + "][schedule][" + newSlot + "][start_time]' placeholder='Start Time' required />");
        var endTimeField = $("<input class='timepicker left' type='text' name='data[" + section + "][schedule][" + newSlot + "][end_time]' placeholder='End Time' required />");
        var deleteLink = $("<a data-schedulefield='" + newSlot + "' href='javascript:void(0)'>remove</a>");
        var errorAlert = $("<small class='error'>Please add a time schedule.</small>");

        // have delete link
        deleteLink.click(function() {
            var slot = $(this).data("schedulefield");
            $(this).remove();
            $("select[name='data[" + section + "][schedule][" + slot + "][day]']").parents(".course-schedule").remove();

            // turn on foundation on the page
            $(document).foundation();
        });

        // populate select day field
        $.each(daysOfTheWeek, function() {
            daysSelectField.append($('<option></option>').attr("value", this.id).text(this.day));
        });

        startTimeField.timepicker();
        endTimeField.timepicker();

        // populate courseDiv
        courseScheduleDiv.append("<label />").append(deleteLink);
        courseScheduleDiv.find("label").append(daysSelectField).append(startTimeField).append(endTimeField).append(errorAlert);

        // append new course schedule div
        courseScheduleDiv.insertAfter(".course-schedule:last");


        // turn on foundation on the page
        $(document).foundation();


        // Timepicler
        $(".timepicker").timepicker().on('show.timepicker', function(e) {
            $(".timepicker").not(this).timepicker('hideWidget');
        });

    });
});