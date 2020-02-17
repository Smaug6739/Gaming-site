$(document).ready(function() {

    $(document).on("keyup", "#in_pseudo", function(e) {
        if(validatePseudo($(this).val())) {
            $(this).css("border", "2px solid green")
        } else {
            $(this).css("border", "2px solid red")
        }
    })

    $(document).on("keyup", "#in_mail", function(e) {
        if(validateEmail($(this).val())) {
            $(this).css("border", "2px solid green")
        } else {
            $(this).css("border", "2px solid red")
        }
    })

    $(document).on("keyup", "#ta_demande", function(e) {
        if($(this).val().length > 3) {
            $(this).css("border", "2px solid green")
        } else {
            $(this).css("border", "2px solid red")
        }
    })

    $(document).on("click touchstart", "#btn_submit", function(e) {

        let pseudo = ""
        let mail = ""
        let message = ""
        let error = 0

        if($("#in_pseudo").val() != "") {
            pseudo = $("#in_pseudo").val()
        } else {
            error++
            $("#in_pseudo").css("border", "2px solid red")
        }

        if($("#in_mail").val() != "") {
            mail = $("#in_mail").val()
        } else {
            error++
            $("#in_mail").css("border", "2px solid red")
        }

        if($("#ta_demande").val() != "") {
            message = $("#ta_demande").val()
        } else {
            error++
            $("#ta_demande").css("border", "2px solid red")
        }

        if(error === 0) {

            $.post("../models/contact.php", {
                a:"demande",
                in_name:pseudo,
                in_mail:mail,
                ta_message:message
            }, function(data) {
                if(data) {
                    if(data.error) {
                        displayNotif(1, data.errorStr)
                    } else {
                        displayNotif(0, "Succès !")
                    }
                }
            }, "json")

        }
    })
})

function displayNotif(type, message) {
    let color = ""
    switch (type) {
        case 0:
            color = "green"
            break;
        case 1:
            color = "red"
            break;
    }

    $("#in_pseudo").val("")
    $("#in_mail").val("")
    $("#ta_demande").val("")

    $("#notif").toggleClass("notif-"+color)
    $("#notif").html("<p>"+message+"</p>")
    $("#notif").animate({
        opacity:"1"
    }, 500)

    setTimeout(function() {
        $("#notif").animate({
            opacity:"0"
        }, 500, function() {
            $("#hidden-form").toggleClass("d-none")
        })
    }, 3000)

}

function validatePseudo(val) {
    let regex = /^[a-zA-Z0-9 !@#~$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/
    if(val.match(regex) && val.length > 2) {
        return true
    }
    return false
}

function validateEmail(val) {
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if(val.match(regex) && val.length > 3) {
        return true
    }
    return false
}
