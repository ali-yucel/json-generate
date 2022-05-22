<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Json Generate Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
      <style>
         .jumbotron {
            padding: 10px 20px !important;
         }
      </style>
   </head>
   <body>
      <div class="jumbotron text-center" style="margin-bottom:0">
         <h1>Json Generate Page</h1>
         <p>Quickly generate json: simple and fast</p>
      </div>
      <div class="container-fluid px-0">
         <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
            <a class="navbar-brand" href="/jsonx">Home</a>
            <a class="navbar-brand" href="?section=themebanner">ThemeBanner</a>
            <a class="navbar-brand" href="https://www.tema.org.tr/fidan-bagisi-secenekleri" target="_blank">Donate</a>
         </nav>
      </div>
      <?php 
         if($_GET['section'] == "themebanner"){
            $data = array(
               "section_title" => 'Anasayfa Tema Bannerları',
               "min_number"    => 1,
               "max_number"    => 20,
               "key_prefix"    => 'theme_banner',
               "label_prefix"    => 'Tema Banner'
            );
         }
      ?>
      <form id="form_data" method="post" action="#" enctype="multipart/form-data">
         <div class="container-fluid" style="margin-top:30px">
         <div class="row">
            <div class="col-lg-2">
               <div class="row">
                  <div class="col-12 mb-3">
                     <label for=""><b>Section Title</b></label>
                     <input type="text" class="form-control" name="section_title" value="<?php echo $data["section_title"]; ?>">
                  </div>
                  <div class="col-12 mb-3">
                     <label for=""><b>Min Number (for loop)</b></label>
                     <input type="text" class="form-control" name="min_number" value="<?php echo $data["min_number"]; ?>">
                  </div>
                  <div class="col-12 mb-3">
                     <label for=""><b>Max Number (for loop)</b></label>
                     <input type="text" class="form-control" name="max_number" value="<?php echo $data["max_number"]; ?>">
                  </div>
                  <div class="col-12 mb-3">
                     <label><b>Key Prefix</b></label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="key_prefix" value="<?php echo $data["key_prefix"]; ?>">
                        <div class="input-group-append">
                           <button id="key_replace" class="btn btn-outline-secondary" type="button">Replace</button>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 mb-3">
                     <label><b>Label Prefix</b></label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="label_prefix" value="<?php echo $data["label_prefix"]; ?>">
                        <div class="input-group-append">
                           <button id="label_replace" class="btn btn-outline-secondary" type="button">Replace</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg">
                  <table class="table table-bordered" id="dynamic_field">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Type</th>
                           <th scope="col">Key</th>
                           <th scope="col">Label</th>
                           <th scope="col">Default Value</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        if($_GET['section'] == "themebanner") { 
                           include("theme-banner.php"); 
                        } else { ?>
                           <tr>
                              <td scope="row">1</td>
                              <td>
                                 <select class="form-control" name="items[1][type]">
                                    <option value="" disabled selected>Choose Type</option>
                                    <option value="text">Text</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="image">İmage</option>
                                    <option value="codeeditor">Codeeditor</option>
                                    <option value="textarea">Textarea</option>
                                 </select>
                              </td>
                              <td> 
                                 <input type="text" class="form-control" name="items[1][key]">
                              </td>
                              <td>
                                 <input type="text" class="form-control" name="items[1][label]">
                              </td>
                              <td>
                                 <input type="text" class="form-control" name="items[1][default_value]">
                              </td>
                              <td>
                                 <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                              </td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <div class="text-right">
                     <a href="javascript:void(0)" class="btn btn-primary" id="submit">Json Generate</a>
                  </div>
            </div>
            <div class="col-lg-auto">
                  <textarea style="width:450px;height:85%;" class="form-control" id="output" disabled>empty :)</textarea>
                  <div class="text-right">
                     <a href="javascript:void(0)" class="btn btn-success mt-3" id="clipboard">Copy of Clipboard</a>
                  </div>
            </div>
         </div>
         </div>
      </form>
      <div class="jumbotron text-center" style="margin:100px 0 0">
         <p>Footer</p>
      </div>

      <script>

        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
              i++;
              $('#dynamic_field').append('<tr id="row'+i+'"> <td scope="row">'+i+'</td> <td class="text-semibold text-dark"><select class="form-control" name="items['+i+'][type]"><option value="" disabled selected>Choose Type</option> <option value="text">Text</option> <option value="checkbox">Checkbox</option> <option value="image">İmage</option> <option value="codeeditor">Codeeditor</option> <option value="textarea">Textarea</option> </select> </td> <td> <input type="text" class="form-control"name="items['+i+'][key]"> </td> <td> <input type="text" class="form-control" name="items['+i+'][label]"> </td> <td> <input type="text" class="form-control" name="items['+i+'][default_value]"> </td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></td> </tr>');
            }); 
            
            $(document).on('click', '.btn_remove', function(){
              var button_id = $(this).attr("id"); 
              $('#row'+button_id+'').remove();
            });
            
            $('#key_replace').click(function(){
               var inputval1  = $('[name=key_prefix]').val();
               $('input[name*="[key]"]').each(function(){
                  var inputval2  = $(this).val();
                  $(this).val(inputval2.replace('#keyprefix',inputval1));
               });
            });

            $('#label_replace').click(function(){
               var inputval1  = $('[name=label_prefix]').val();
               $('input[name*="[label]"]').each(function(){
                  var inputval2  = $(this).val();
                  $(this).val(inputval2.replace('#labelprefix',inputval1));
               });
            });

            $('#submit').click(function(){
                $.ajax({
                    url:"calc.php",
                    method:"POST",
                    data:$('#form_data').serialize(),
                     beforeSend: function() {
                        $('#output').text('empty');
                        $('#submit').html('<div class="spinner-border spinner-border-sm text-white"></div> Json Loading...');
                     },
                     complete: function(){ 
                        $('#submit').text('Json Generate');
                     },
                    success:function(data)
                    {
                        $('#output').text(data);
                    }
                });
            });
          });
      </script>
   </body>
</html>