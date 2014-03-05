$(document).ready(function() {

    $(document).foundation();

    // Timepicler
    $(".timepicker").timepicker();

    // delete link for schedule time
    $(".timeschedule-delete").click(function() {
        var slot = $(this).data("schedulefield");

        // get how many fields there are
        var timeSlots = $(".course-schedule").length

        // only remove when its more than one time slot
        if (timeSlots > 1)
            $("select[name='data[course][schedule][" + slot + "][day]']").parent().remove();
        else
            alert("You need to have atleast one time slot that your course meets!");

        // turn on foundation on the page
        $(document).off().foundation();
    });
    // add new timeschedule times
    $("#addNewTimescheduleField").click(function() {

        // get how many fields there are
        var timeSlots = $(".course-schedule").length;
        var newSlot = timeSlots;

        // Append new slot to the times offered section
        var daysOfTheWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        var courseScheduleDiv = $("<div class='course-schedule' />");
        var daysSelectField = $("<select class='columns large-4 left' name='data[course][schedule][" + newSlot + "][day]' required><option>-- Select Day --</option></select>");
        var startTimeField = $("<input class='timepicker left' type='text' name='data[course][schedule][" + newSlot + "][start_time]' placeholder='Start Time' required />");
        var endTimeField = $("<input class='timepicker left' type='text' name='data[course][schedule][" + newSlot + "][end_time]' placeholder='End Time' required />");
        var deleteLink = $("<a data-schedulefield='" + newSlot + "' href='javascript:void(0)'>remove</a>");
        var errorAlert = $("<small class='error'>Please add a time schedule.</small>");

        // have delete link
        deleteLink.click(function() {
            var slot = $(this).data("schedulefield");
            $(this).remove();
            $("select[name='data[course][schedule][" + slot + "][day]']").parents(".course-schedule").remove();

            // turn on foundation on the page
            $(document).off().foundation();
        });

        // populate select day field
        $.each(daysOfTheWeek, function() {
            daysSelectField.append($('<option></option>').attr("value", this).text(this));
        });

        startTimeField.timepicker();
        endTimeField.timepicker();

        // populate courseDiv
        courseScheduleDiv.append("<label />").append(deleteLink);
        courseScheduleDiv.find("label").append(daysSelectField).append(startTimeField).append(endTimeField).append(errorAlert);

        // append new course schedule div
        courseScheduleDiv.insertAfter(".course-schedule:last");


        // turn on foundation on the page
        $(document).off().foundation();
    });
});