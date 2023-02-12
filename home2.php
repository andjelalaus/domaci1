<?php

require "dataBroker.php";
require "model2/profesor.php";
require "model2/zvanja.php";
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index2.php');
    exit();
}
$zvanja = Zvanje::getAll($conn);
if (!$zvanja) {
    echo "Error reading roles";
    die();
}
if ($zvanja->num_rows == 0) {
    echo "No roles";
    die();
}

$profe = Professor::getAll($conn);
if (!$profe) {
    echo "Error reading professors";
    die();
}
if ($profe->num_rows == 0) {
    echo "No professors";
    die();
} else {
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Nastavnici</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/homestyle.css">
    <style>
   
      h1 {
        text-align: center;
        margin-top: 50px;
      }
      table {
        margin: 0 auto;
        width: 80%;
        margin-top: 50px;
        font-family:'Courier New', Courier, monospace;
        font-size: 22px;
        font-weight:bold;
        
      }
      th, td {
        text-align: center;
      }
    
    </style>
  </head>
  <body>
    <h1>Server Professors by their Role</h1>
    <div id="prikazProfi">
    <table id="myTable" class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">First Day of Employment</th>
          <th scope="col">Last Day of Employment</th>
          <th scope="col">Role in Job</th>
          <th scope="col">Select</th>
        </tr>
      </thead>
      <tbody>
        <?php
                    while ($line = $profe->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $line["ime"] ?></td>
                            <td><?php echo $line["prezime"] ?></td>
                            <td><?php echo $line["datumOd"] ?></td>
                            <td><?php echo $line["datumDo"] ?></td>
                            <td><?php echo $line["naziv"] ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $line["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>
                <?php
                    endwhile;
                }
                ?>

      </tbody>
    </table>
              </div>
    <div style="text-align: center; margin-top: 50px;">
      <!--<button type="button" class="btn btn-primary">Change Professors</button>-->
      <button id="changeForm" type="button" class="btn btn-success">Change Professor</button>
    <div class="form-popup" id="myFormChange">
      <form action="#" method="post" id="changeform">
        <h2>Change Professor</h2>
        <div class="form-group">
                                        <input id="id" type="text" name="id" class="form-control" placeholder="Id *" value="" readonly />
                                    </div>
        <input id="name" type="text" placeholder="Name"  name="name"> 
        <input id="lastName" type="text" placeholder="Last Name" name="lastName">
        <div>
          
          <input id="firstDay" type="text" name="firstDay" placeholder="FirstDay" value="">
        </div>
        <div>
          
          <input id="lastDay" type="text"  name="lastDay" placeholder="LastDay" value="">
        </div>
       <!-- <input id="role" type="text"  placeholder="Role" name="role"> -->
        <label for="role">Role:</label>
        <select id="role" name="role" required>
    <?php
      // Connect to database and retrieve roles
      $roles = Zvanje::getAll($conn);
      foreach ($roles as $role) {
        echo "<option value='".$role['id']."'>".$role['naziv']."</option>";
      }
    ?>
  </select>
        <button type="submit" class="btn">Submit</button>
        <button type="button" class="btn cancel" onclick="closeFormC()">Close</button>
      </form>
    </div>
    <script>
      // Function to open the form
      function openFormC() {
      document.getElementById("myFormChange").style.display = "block";
      }
      // Function to close the form
      function closeFormC() {
        
        document.getElementById("myFormChange").style.display = "none";
      }
   

      // Event listener for the button to open the form
      
    document.getElementById("changeForm").addEventListener("click", openFormC);
    </script>
      <button type="button" class="btn btn-primary"  onclick=" sortTable(0)">Sort Professors by Name</button>
      <button type="button" class="btn btn-primary"  onclick="sortTable(1)">Sort Professors by Lastname</button>
      <button type="button" class="btn btn-primary"  onclick=" sortTable(4)">Sort Professors by role</button>
      
      <button type="button" formmethod="post" id="brisi" class="btn btn-danger">Delete Professors</button>
    </div>
    
    <div style="float: right; margin-right: 50px; margin-top: 50px;">
    <button type="button" class="btn btn-secondary" onclick="show()">Select All Professors</button> 
    
       <!-- <button type="button" class="btn btn-success">Add Professor</button>-->
       <style>
      /* Pop-up form styling */
      .form-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        box-shadow: 0 0 10px #ccc;
        padding: 20px;
        border-radius: 10px;
      }

      /* Input field styling */
      input[type="text"],
      textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }

      /* Submit button styling */
      button[type="submit"] {
        width: 100%;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: cornflowerblue;
        color: white;
        border: none;
        font-weight: bold;
        cursor: pointer;
      }
    </style>

    <button id="openForm" type="button" class="btn btn-success">Add Professor</button>
    <div class="form-popup" id="myForm">
      <form action="#" method="post" id="addform">
        <h2>Add Professor</h2>
        <input type="text" placeholder="Name"  name="name">
        <input type="text" placeholder="Last Name" name="lastName">
        <div>
          <label for="first-day-of-employment">First Day of Employment:</label>
          <input type="date" id="first-day-of-employment" name="first-day-of-employment">
        </div>
        <div>
          <label for="last-day-of-employment">Last Day of Employment:</label>
          <input type="date" id="last-day-of-employment" name="last-day-of-employment">
        </div>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
    <?php
      // Connect to database and retrieve roles
      $roles = Zvanje::getAll($conn);
      foreach ($roles as $role) {
        echo "<option value='".$role['id']."'>".$role['naziv']."</option>";
      }
    ?>
  </select>
        <button type="submit" class="btn">Submit</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>

    <script>
      // Function to open the form
      function openForm() {
        document.getElementById("myForm").style.display = "block";
       
      }
    
      // Function to close the form
     
      function closeForm() {
        
        document.getElementById("myForm").style.display = "none";
      }

      // Event listener for the button to open the form
      document.getElementById("openForm").addEventListener("click", openForm);
   
    </script>
    <br><br>
    <div>
      <h4> Search Professor by name</h4>
      <input type="text" id="myInput" onkeyup="funkcijaZaPretragu(0)" placeholder="Pretrazi profe">
      <h4> Search Professor by role</h4>
      <input type="text" id="myInput" onkeyup="funkcijaZaPretragu(4)" placeholder="Pretrazi profe">
    </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="javascript/glavni.js"></script>
   
      
    </div>
    
    <div id="prikazZvanja">
 
    <table id="myTableZ" class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col">Name</th>
     
          <th scope="col">Select</th>
        </tr>
      </thead>
      <tbody>
        <?php
                    while ($line = $zvanja->fetch_array()) :
                    ?>
                        <tr class="table-info">
                            
                            <td><?php echo $line["naziv"] ?></td>
                           
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donutZ" value=<?php echo $line["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>
                <?php
                    endwhile;
                
                ?>

      </tbody>
    </table>
              </div>
              
              <div style="text-align: center; margin-top: 50px;"> 
              <button id="openFormZ" type="button" class="btn btn-success">Add Role</button>
    <div class="form-popup" id="myFormZ">
      <form action="#" method="post" id="dodajZ">
        <h2>Add Role</h2>
        <input type="text" placeholder="Name"  name="nameZ">
        <button type="submit" class="btn">Submit</button>
        <br><br>
        <button type="button" class="btn cancel" onclick="closeFormZ()">Close</button>
      </form>
    </div>
    <button id="changeFormZ" type="button" class="btn btn-success">Change Role</button>

    <div class="form-popup" id="myFormChangeZ">
      <form action="#" method="post" id="changeformZ">
        <h2>Change Role</h2>
        <div class="form-group">
                                        <input id="idZ" type="text" name="idZ" class="form-control" placeholder="Id *" value="" readonly />
                                    </div>
        <input id="nameZC" type="text" placeholder="Name"  name="nameZC" value=""> 
       
        <button type="submit" class="btn">Submit</button>
        <br><br>
        <button type="button" class="btn cancel" onclick="closeFormCZ()">Close</button>
      </form>
      
                  </div>
                  <button type="button" formmethod="post" id="brisiZ" class="btn btn-danger">Delete Role</button>
    <script>
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
    const checked = $('input[name=checked-donutZ]:checked');
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
    
        const checked = $('input[name=checked-donutZ]:checked');
    
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
      // Function to open the form
      function openFormZ() {
        document.getElementById("myFormZ").style.display = "block";
      }
      function openFormCZ() {
        document.getElementById("myFormChangeZ").style.display = "block";
      }

      // Function to close the form
      function closeFormZ() {
        document.getElementById("myFormZ").style.display = "none";
      }
      function closeFormCZ() {
        document.getElementById("myFormChangeZ").style.display = "none";
      }

      // Event listener for the button to open the form
      document.getElementById("openFormZ").addEventListener("click", openFormZ);
    document.getElementById("changeFormZ").addEventListener("click", openFormCZ);
 

          function sortTable(arg) {
              var table, rows, switching, i, x, y, shouldSwitch;
              table = document.getElementById("myTable");
              switching = true;
  
              while (switching) {
                  switching = false;
                  rows = table.rows;
                  for (i = 1; i < (rows.length - 1); i++) {
                      shouldSwitch = false;
                      x = rows[i].getElementsByTagName("TD")[arg];
                      y = rows[i + 1].getElementsByTagName("TD")[arg];
                      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                          shouldSwitch = true;
                          break;
                      }
                  }
                  if (shouldSwitch) {
                      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                      switching = true;
                  }
              }
          }
          

  
          function funkcijaZaPretragu(arg) {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[arg];
                  if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                          tr[i].style.display = "";
                      } else {
                          tr[i].style.display = "none";
                      }
                  }
              }
          }
          
          function show() {
    var t = document.getElementById("prikazProfi");
    if (t.style.display === "none") {
      t.style.display = "block";
    } else {
      t.style.display = "none";
    }
  }
      </script>
  
    </div>
  </body>
</html>
