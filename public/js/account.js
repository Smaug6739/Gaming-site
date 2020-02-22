$(document).ready(function() {
    
    $(document).on("keyup", "#in_pass", function(e) {
        let strength = verifyStrength($(this))
        
        switch(strength) {
            case "strong":
                $(this).css("background-color", "#94c769")
                break;
            case "medium":
                $(this).css("background-color", "#f7bd4a")
                break;
            case "weak":
                $(this).css("background-color", "#df7f7f")
                break;
        }
        
        if($(this).val() == "") {
            $(this).css("background-color", "white")
        }
    })
    
    $(document).on("keyup", "#in_confirm", function(e) {
        
        if($(this).val() != $("#in_pass").val()) {
            $(this).css("background-color", "#df7f7f")
        } else {
            $(this).css("background-color", "#94c769")
        }
    })
    
    $(document).on("click touchend", "#btn_modif, #btn_add", function(e) {
        if(e.type == "touchend") {
            $(this).off("click")
        }
        
        let error = 0
        
        if(validatePseudo($("#in_login").val())) {
            var newPseudo = $("#in_login").val()
        } else {
            $("#in_login").css("border", "2px solid red")
            error++
        }
        
        if(verifyStrength($("#in_pass")) != "weak" && $("#in_pass").val() === $("#in_confirm").val()) {
            var newPass = $("#in_pass").val()
        } else {
            $("#in_pass").css("border", "2px solid red")
            $("#in_confirm").css("border", "2px solid red")
            error++
        }
        
        if(error === 0) {
            if($(e.currentTarget).attr("id") == "btn_modif") {
                $.post("../models/admin.php", {
                    a:"updateAccount",
                    pseudo:newPseudo,
                    pass:newPass
                }, function(data) {
                    if(data) {
                        if(!data.error) {
                            displayNotif(0, "Succes")
                        } else {
                            displayNotif(1, "Erreur")
                        }
                    }
                }, "json")
            } else {
                $.post("../models/admin.php", {
                    a:"createAccount",
                    pseudo:newPseudo,
                    pass:newPass
                }, function(data) {
                    if(data) {
                        if(!data.error) {
                            displayNotif(0, "Succes")
                        } else {
                            displayNotif(1, "Erreur")
                        }
                    }
                }, "json")
            }
        } else {
            
        }
    })
})

function validatePseudo(val) {
    let regex = /^[a-zA-Z0-9 !@#~$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/
    if(val.match(regex) && val.length > 2) {
        return true
    }
    return false
}

function verifyStrength(el) {
    let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})");
    let strength = ""
    
    if(strongRegex.test($(el).val())) {
        strength = "strong"
    } else if (mediumRegex.test($(el).val())) {
        strength = "medium"
    } else {
        strength = "weak"
    }
    
    return strength
}

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

    $("#in_login").val("")
    $("#in_pass").val("")
    $("#in_confirm").val("")

    $("#notif").removeClass("notif-red")
    $("#notif").removeClass("notif-green")
    $("#notif").addClass("notif-"+color)
    $("#notif").html("<p>"+message+"</p>")
    $("#notif").animate({
        opacity:"1"
    }, 500)

    setTimeout(function() {
        $("#notif").animate({
            opacity:"0"
        }, 500, function() {
            window.location.href = "http://french-gaming-family.yj.fr/admin/"
        })
    }, 2000)

}