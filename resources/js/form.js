$(document).ready(function () {
    var currentStep = 1;

    const prevButton = $(".prev-btn");
    const nextButton = $(".next-btn");
    const submitButton = $(".submit-btn");
    const progressBar = $(".progress-bar");

    const elementsWithStepAttribute = $("[data-step]").toArray();
    console.log(elementsWithStepAttribute.length);

    function showStep(step) {
        $(".step").hide();
        $(".step[data-step=" + step + "]").show();

        var progress = (step - 1) / (elementsWithStepAttribute.length - 1) * 100;
        progressBar.css("width", progress + "%");
        progressBar.attr("aria-valuenow", progress);

        if (elementsWithStepAttribute.length == step) {
            nextButton.addClass("disabled");
            submitButton.removeClass("disabled");
        } else if (step > 1 && elementsWithStepAttribute.length != step) {
            prevButton.removeClass("disabled");
            nextButton.removeClass("disabled");
            submitButton.addClass("disabled");
        } else if (step == 1) {
            prevButton.addClass("disabled");
            submitButton.addClass("disabled");
            nextButton.removeClass("disabled");
        }
    }

    showStep(currentStep);

    $(".next-btn").click(function () {
        currentStep++;
        showStep(currentStep);
    });

    $(".prev-btn").click(function () {
        currentStep--;
        showStep(currentStep);
    });

    $("#multi-step-form").submit(function (e) {
        e.preventDefault();
    });



    //Form handle fields
    $("#myForm :input").on("change", function() {
        var field = $(this);
        updateDocument(field);
    });

    function updateDocument(field) {
        //text
        console.log("a");

        if(field.attr("type") == "text") {
            var $span = $("span#" + field.attr("name"));

            console.log(field.val());
            if(field.val()) {
                $span.html(field.val());
            } else {
                $span.html("__________");
            }
        } else if (field.attr("type") == "checkbox") {
            var $span = $("span#" + field.attr("name"));

            if (field.is(":checked")) {
                var content = $span.html().replace("&nbsp;&nbsp;", "&nbsp;X&nbsp;");
                $span.html(content);
            } else {
                $span.html($span.html().replace(/X/g, ""));
            }
        } else if (field.attr("type") == "date") {
            var $span = $("span#" + field.attr("name"));

            if (field.val()) {
                $span.html(transformDateFormat(field.val()))
            } else {
                $span.html("____/____/____");
            }
        } else {
            var $spansOfSelectId = $("#" + field.attr("id") + " span");

            $spansOfSelectId.each(function() {
                var $span = $(this);

                if ($span.attr("id") === field.val()) {
                    var content = $span.html().replace("&nbsp;&nbsp;", "&nbsp;X&nbsp;");
                    $span.html(content);

                } else {
                    $span.html($span.html().replace(/X/g, ""));
                }
            });
        }
    }

    function transformDateFormat(inputDate) {
        var parts = inputDate.split('-');
        if (parts.length === 3) {
          var year = parts[0];
          var month = parts[1];
          var day = parts[2];

          // Ensure that year, month, and day are formatted as two digits each
          year = year.padStart(4, '0');
          month = month.padStart(2, '0');
          day = day.padStart(2, '0');

          var transformedDate = day + '/' + month + '/' + year;
          console.log(transformedDate);
          return transformedDate;
        } else {
          return "Invalid Date Format";
        }
    }
});
