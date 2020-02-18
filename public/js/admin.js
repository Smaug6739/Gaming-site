$(document).ready(function() {
    
    $(document).on("click touchend", ".treatment-btn", function(e) {
        
        if(e.type == "touchend") {
            $(this).off("click")
        }
        
        let id = $(this).attr("data-id")
        achieve(id)
    })
    
    $(document).on("click touchend", ".del-btn", function(e) {
        
        if(e.type == "touchend") {
            $(this).off("click")
        }
        
        let id = $(this).attr("data-id")
        deleteAsk(id)
    })
})

function achieve(id) {
    $.post("models/admin.php", {
        a:"achieve",
        id:id
    }, function(data) {
        if(data) {
            console.log(data)
        }
    }, "json")
}

function deleteAsk(id) {
    $.post("models/admin.php", {
        a:"delete",
        id:id
    }, function(data) {
        if(data) {
            console.log(data)
        }
    }, "json")
}

