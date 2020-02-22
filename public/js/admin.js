var pending
var achieved

$(document).ready(function() {
    
    $(document).on("click touchend", ".treatment-btn", function(e) {
        e.stopPropagation()
        if(e.type == "touchend") {
            $(this).off("click")
        }
        
        let id = $(this).attr("data-id")
        achieve(id)
    })
    
    $(document).on("click touchend", ".del-btn", function(e) {
        e.stopPropagation()
        if(e.type == "touchend") {
            $(this).off("click")
        }
        
        let id = $(this).attr("data-id")
        let pseudo = $(this).attr("data-pseudo")
        
        if(confirm("Supprimer la demande de "+pseudo+" ?")) {
            deleteAsk(id)
        }
    })
    
    pending = $("#pending").DataTable({
        paging:false,
        searching:false,
        sorting:false,
        info:false,
        language: {
            emptyTable:"Aucune demande en attente"
        },
        ajax: {
            url: '../models/admin.php',
            type: 'POST',
            dataSrc: 'data',
            data: {
                a:"getPending"
            }
        },
        columns: [
            {
                title:"Pseudo",
                data:"pseudo"
            },
            {
                title:"Mail",
                data:"mail"
            },
            {
                title:"Message",
                data:"message"
            },
            {
                title:"Date",
                data:"date"
            },
            {
                title:"Actions",
                data:"id",
                createdCell: function (td, cellData, rowData, row, col) {
                    let aff = ''
                    
                    aff += "<button id='treatment_btn_"+cellData+"' data-id='"+cellData+"' class='btn btn-success treatment-btn'>Traiter</button>";
                    aff += "<button id='del_btn_"+cellData+"' data-pseudo='"+rowData.pseudo+"' data-id='"+cellData+"' class='btn btn-danger del-btn'>Supprimer</button>";
                    
                    $(td).html(aff)
                    
                }
            }
        ]
    })
    
    achieved = $("#achieved").DataTable({
        paging:false,
        searching:false,
        sorting:false,
        info:false,
        language: {
            emptyTable:"Aucune demande traitée"
        },
        ajax: {
            url: '../models/admin.php',
            type: 'POST',
            dataSrc: 'data',
            data: {
                a:"getAchieved"
            }
        },
        columns: [
            {
                title:"Pseudo",
                data:"pseudo"
            },
            {
                title:"Mail",
                data:"mail"
            },
            {
                title:"Message",
                data:"message"
            },
            {
                title:"Date",
                data:"date"
            },
            {
                title:"Actions",
                data:"id",
                createdCell: function (td, cellData, rowData, row, col) {
                    let aff = ''
                    
                    aff += "<button id='del_btn_"+cellData+"' data-pseudo='"+rowData.pseudo+"' data-id='"+cellData+"' class='btn btn-danger del-btn'>Supprimer</button>";
                    
                    $(td).html(aff)
                    
                }
            }
        ]
    })
})

function achieve(id) {
    $.post("../models/admin.php", {
        a:"achieve",
        id:id
    }, function(data) {
        if(data) {
            pending.ajax.reload()
            achieved.ajax.reload()
        }
    }, "json")
}

function deleteAsk(id) {
    $.post("../models/admin.php", {
        a:"delete",
        id:id
    }, function(data) {
        if(data) {
            pending.ajax.reload()
            achieved.ajax.reload()
        }
    }, "json")
}

