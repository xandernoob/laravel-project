$(document).ready(function() {
    $('#condos').validate({
        rules: {
            owner: "required",
            unit: "required",
            contact: {
                required: true,
                number: true,
            }
        },
        messages: {
            owner: 'This field is required',
            unit: 'This field is required',
            contact: 'This field is required',

        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    $('#visitor').validate({
        rules: {
            name: "required",
            contact: {
                required: true,
                number: true,
            },
            unit: "required",
            nric: {
                required: true,
                maxlength: 3,
                minlength: 3,
            },
        },
        messages: {
            name: 'This field is required',
            contact: 'This field is required',
            unit: 'This field is required',
            nric: 'Please enter last 3 digit of NRIC',
        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    
});