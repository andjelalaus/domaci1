$('#addform').submit(function(){
    event.preventDefault();
    console.log("Add");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serialized = $form.serialize();
    console.log(serialized);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handle/add.php',
        type:'post',
        data: serialized
    });

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success si"){
            alert("Dodat profa");
            console.log("Dodat profa");
            location.reload(true);
        }else console.log("Profa nije dodat "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

$('#brisi').click(function(){
    console.log("Delete");

    const checked = $('input[name=checked-donut]:checked');

    req = $.ajax({
        url: 'handle/delete.php',
        type:'post',
        data: {'id':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success si"){
           checked.closest('tr').remove();
           alert('Obrisan profa');
           console.log('Obrisan');
        }else {
        console.log("Profa nije obrisan "+res);
        alert("Profa nije obrisan ");

        }
        console.log(res);
    });

});

// dugme koje je na glavnoj formi i otvara dijalog za izmenu
$('#changeForm').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    //pristupa informacijama te konkretne forme i popunjava dijalog
    request = $.ajax({
        url: 'handle/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');
        $('#name').val(response[0]['ime']);
        console.log(response[0]['ime']);

        $('#lastName').val(response[0]['prezime'].trim());
        console.log(response[0]['prezime'].trim());

        $('#firstDay').val(response[0]['datumOd']);
        console.log(response[0]['datumOd']);

        $('#lastDay').val(response[0]['datumDo']);
        console.log(response[0]['datumDo']);

        $('#role').val(response[0]['zvanje_id'].trim());
        console.log(response[0]['zvanje_id'].trim());
        $('#id').val(checked.val());

        console.log(response);
    });

   request.fail(function (jqXHR, textStatus, errorThrown) {
       console.error('The following error occurred: ' + textStatus, errorThrown);
   });

});

//dugme za slanje UPDATE zahteva nakon popunjene forme
$('#changeform').submit(function () {
    event.preventDefault();
    console.log("Changes");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    // kreirati request za UPDATE handler
    req = $.ajax({
        url: 'handle/update.php',
        type:'post',
        data: serializedData
    });
        req.done(function(res,textStatus, jqXHR){
            if(res=="Success si"){
                alert("Izmenjen profa");
                console.log("Izmenjen profa");
                location.reload(true);
            }else console.log("Profa nije izmenjen "+res);
            console.log(res);
        });
    
        req.fail(function (jqXHR, textStatus, errorThrown) {
            console.error('The following error occurred: ' + textStatus, errorThrown);
        });
    });

   


   


$('#btn-pretraga').click(function () {

    var para = document.querySelector('#myInput');
    console.log(para);
    var style = window.getComputedStyle(para);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});

$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});


  

