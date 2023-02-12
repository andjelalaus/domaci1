$('#dodajZ').submit(function(){
    event.preventDefault();
    console.log("Add");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serialized = $form.serialize();
    console.log(serialized);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handleZ/add.php',
        type:'post',
        data: serialized
    });

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success si"){
            alert("Dodato zvanje");
            console.log("Dodato zvanje");
            location.reload(true);
        }else console.log("Zvanje nije dodat "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});


$('#changeFormZ').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    //pristupa informacijama te konkretne forme i popunjava dijalog
    request = $.ajax({
        url: 'handleZ/getZ.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');
        $('#nameZC').val(response[0]['naziv']);
        console.log(response[0]['naziv']);

        $('#idZ').val(checked.val());

        console.log(response);
    });

   request.fail(function (jqXHR, textStatus, errorThrown) {
       console.error('The following error occurred: ' + textStatus, errorThrown);
   });

});

//dugme za slanje UPDATE zahteva nakon popunjene forme
$('#changeformZ').submit(function () {
    event.preventDefault();
    console.log("Changes");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    // kreirati request za UPDATE handler
    req = $.ajax({
        url: 'handleZ/update.php',
        type:'post',
        data: serializedData
    });
        req.done(function(res,textStatus, jqXHR){
            if(res=="Success si"){
                alert("Izmenjen zvanje");
                console.log("Izmenjen zvanje");
                location.reload(true);
            }else console.log("Zvanje nije izmenjen "+res);
            console.log(res);
        });
    
        req.fail(function (jqXHR, textStatus, errorThrown) {
            console.error('The following error occurred: ' + textStatus, errorThrown);
        });
    });
    $('#brisiZ').click(function(){
        console.log("Delete");
    
        const checked = $('input[name=checked-donut]:checked');
    
        req = $.ajax({
            url: 'handleZ/delete.php',
            type:'post',
            data: {'id':checked.val()}
        });
    
        req.done(function(res, textStatus, jqXHR){
            if(res=="Success si"){
               checked.closest('tr').remove();
               alert('Obrisan zvanje');
               console.log('Obrisan');
            }else {
            console.log("Zvanje nije obrisan "+res);
            alert("Zvanje nije obrisan ");
    
            }
            console.log(res);
        });
    
    });

