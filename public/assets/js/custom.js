// next prev function
$(document).ready(function() {

  // Save key

  if(!localStorage.getItem('key')){
    localStorage.setItem('key', makeid(20));
  }

  $.getJSON('https://api.ipregistry.co/?key=omopvam94r2w1h1p', function(data) {
  localStorage.setItem('ip', JSON.stringify(data.ip).replace(/['"]+/g, ''));
  localStorage.setItem('country', JSON.stringify(data.location.country.name).replace(/['"]+/g, ''));
  localStorage.setItem('latitude', JSON.stringify(data.location.latitude).replace(/['"]+/g, ''));
  localStorage.setItem('longitude', JSON.stringify(data.location.longitude).replace(/['"]+/g, ''));
  localStorage.setItem('browser', JSON.stringify(data.user_agent.name).replace(/['"]+/g, ''));
  localStorage.setItem('device', JSON.stringify(data.user_agent.device.type).replace(/['"]+/g, ''));
  localStorage.setItem('os', JSON.stringify(data.user_agent.os.name).replace(/['"]+/g, ''));
});


function getSede(){
  var Str = window.location.pathname
  var sede = Str.replace('/','')
  if(sede == 'cochabamba'){
    return 'CBB'
  }else if(sede == 'el-alto'){
    return 'EAT'
  }else if(sede == 'la-paz'){
    return 'LPZ'
  }else{
    return 'SCZ'
  }
}
// console.log(sede)
  

  var divs = $('.show-section>.steps-inner');
  var now = 0; // currently shown div
  divs.hide().first().show(); // hide all divs except first

  $("#btnContinuar").click(function(){
    $("#step-0").hide();
    $("#step-1").show()
  })

  $("#btnBy").click(function(){
    var isValid = $("input[name=by_]").is(":checked");
    if(isValid){
        var selectedBy = $("input[name=by_]:checked").val();
        if (selectedBy === "Docente") {
            $("#step-1, #step-2, #step-3").hide();
            $("#step-4").show();
        } else {
            $("#step-1").hide();
            $("#step-2").show();
        }
    } else {
        $("#errorBy").show();
    }
  })

  // $(document).on('change', 'input[type=radio][name=sede]', function (event) {
  //   $("#errorSede").hide();
  // });


  $("#btnCarrera").click(function(){
    var isValid = $("input[name=carrera]").is(":checked");
    // console.log(isValid)
    if(isValid){
      $("#step-2").hide();
      $("#step-3").show()
    }else{
      // console.log("Error")
      $("#errorSedeCarrera").hide();
      $("#errorCarrera").show();
    }
  })

  $(document).on('change', 'input[type=radio][name=carrera]', function (event) {

    // Validacion para CCBA

    // var sede = $('input:radio[name=sede]:checked').val()

    var cbb = ['ADM', 'BYF', 'DER', 'DGP',  'ICO', 'IEF', 'MED', 'ODO', 'PSI', 'PYM', 'SIS']
    var eat = ['ADM', 'AHT', 'BYF', 'CPU', 'DER', 'DGP', 'ENF', 'ICO', 'MED', 'ODO', 'PSI', 'SIS']
    var lpz = ['ADM', 'AHT', 'BYF', 'CPU', 'DER', 'DGP', 'ICO', 'IEC', 'MED', 'ODO', 'PER', 'PSI', 'PYM', 'SIS']
    var scz = ['ADM', 'AHT', 'ARQ', 'BYF', 'CPU', 'DER', 'DGP', 'ENF', 'ICO', 'MED', 'ODO', 'PER', 'PSI', 'PYM', 'SIS']

    var value = $(this).val()
    const isInArray = cbb.includes(value)

    if((!cbb.includes(value) && getSede() == 'CBB') || (!eat.includes(value) && getSede() == 'EAT') || (!lpz.includes(value) && getSede() == 'LPZ') || (!scz.includes(value) && getSede() == 'SCZ')){
      $("#btnCarrera").attr("disabled", true);
      $("#errorSedeCarrera").show();
      $("#errorCarrera").hide();
    }else{
      $("#btnCarrera").attr("disabled", false);
      
      $("#errorSedeCarrera").hide();
    }
    $("#errorCarrera").hide();

    // if($(this).val() == 'IEC' && sede == 'CBB'){
    // if(cbba.includes($(this).val()) && sede == 'CBB'){
    //   $("#btnCarrera").attr("disabled", true);
    //   $("#errorSedeCarrera").show();
    //   $("#errorCarrera").hide();
    // }else{
    //   $("#btnCarrera").attr("disabled", false);
      
    //   $("#errorSedeCarrera").hide();
    // }
    // $("#errorCarrera").hide();

  });

  $("#btnSemestre").click(function(){
    var isValid = $("input[name=semestre]").is(":checked");
    // console.log(isValid)
    if(isValid){
      $("#step-3").hide();
      $("#step-4").show()
    }else{
      // console.log("Error")
      $("#errorSemestre").show();
    }
  })

  $(document).on('change', 'input[type=radio][name=semestre]', function (event) {
    console.log($(this).val());

    $("#errorSemestre").hide();
  });
  

  $("#btnSugerencia").click(function(){
    // console.log($("#area").val())
    if($("#area").val() == null){
      $("#errorArea").show();
    }else if ($("#newarea").val() == null || $("#newarea").val() == ''){
      $("#ErrorNewArea").show();  
    } else if ($("input[name=categoria]:checked").length === 0) {
      $("#errorCategoria").show();
    } else if ($("input[name=by_]:checked").length === 0) {
      $("#errorBy").show();
    }else if ($("#sugerencia").val() == null || $("#sugerencia").val() == ''){
      $("#errorSugerencia").show();
    }else{
      // $("#step-4").hide();

      // ajax!!

      var sede = getSede();
      var carrera = $("input[name=carrera]:checked").val();
      var semestre = $("input[name=semestre]:checked").val();
      var area = $("#area").val()
      var newarea = $("#newarea").val()
      var categoria = $("input[name=categoria]:checked").val();
      var by_ = $("input[name=by_]:checked").val();
      var sugerencia = $("#sugerencia").val()
      var key = localStorage.getItem('key')
      var ip = localStorage.getItem('ip')
      var country = localStorage.getItem('country')
      var latitude = localStorage.getItem('latitude')
      var longitude = localStorage.getItem('longitude')
      var browser = localStorage.getItem('browser')
      var device = localStorage.getItem('device')
      var os = localStorage.getItem('os')

      $("#btnSugerencia").attr("disabled", true);
      $("#btnSugerencia").text("Cargando...")


      $.ajax({
        type:'POST',
        url:"/suggestion-store",
        data:{
          sede:sede, 
          carrera:carrera,
          semestre: semestre,
          area: area,
          newarea:newarea,
          by_: by_,
          categoria: categoria,
          sugerencia: sugerencia,
          key: key,
          device: device,
          browser: browser,
          ip: ip,
          country: country,
          latitude: latitude,
          longitude: longitude,
          os: os
        },
        success:function(data){

          console.log(data)
          $("#btnSugerencia").attr("disabled", false);
          $("#step-4").hide();
          $("#step-5").show()
            //  if($.isEmptyObject(data.error)){
            //      alert(data.success);
            //      location.reload();
            //  }else{
            //      printErrorMsg(data.error);
            //  }
        }
     });



      // $("#step-5").show()
    }

    
    // var isValid = $("input[name=semestre]").is(":checked");
    // console.log(isValid)
    // if(isValid){
    //   $("#step-3").hide();
    //   $("#step-4").show()
    // }else{
    //   console.log("Error")
    //   $("#errorSemestre").show();
    // }
  })


  $(document).ready(function() {
    $('#area').on('change', function() {
        var selectedArea = $(this).val();    
        var opcionEspecifica = "OTROS";
        if (selectedArea === opcionEspecifica) {
            $('#newarea').show();
            $("#newarea").on('change', function() {
              $("#ErrorNewArea").hide()
            });
        } else {
            $('#newarea').hide();
        }
    });
  });

  $("#area").on('change', function() {
    $("#errorArea").hide()
  });
  

  $(document).on('change', 'input[type=radio][name=categoria]', function (event) {
      var selectedCategoria = $("input[name=categoria]:checked").val();

      if (selectedCategoria === undefined) {
          $("#errorCategoria").show();
      } else {
          $("#errorCategoria").hide();
      }
  });

  $(document).on('change', 'input[type=radio][name=by_]', function (event) {
      var selectedBy = $("input[name=by_]:checked").val();

      if (selectedBy === undefined) {
          $("#errorBy").show();
      } else {
          $("#errorBy").hide();
      }
  });

  $("#sugerencia").keyup(function() {
    var value = $(this);
    if(value.length != 0 || value != ""){
      $("#errorSugerencia").hide();
    }
  });




  $("#btnHome").click(function(){
    location.reload();
  })
  // btnSugerencia


  $("#prev-1").click(function() {
     $("#step-1").hide();
     $("#step-0").show()
  });

  $("#prev-2").click(function() {
    $("#step-2").hide();
    $("#step-1").show()
  });

  $("#prev-3").click(function() {
    $("#step-3").hide();
    $("#step-2").show()
  });
  
  $("#prev-4").click(function() {
    var selectedBy = $("input[name=by_]:checked").val();
    if (selectedBy === "Docente") {
        $("#step-4").hide();
        $("#step-1").show();
    } else {
        $("#step-4").hide();
        $("#step-3").show()
    }
});


});

// label active on input check
$(document).ready(function()
{
  $('.form-input input').on("change", function()
  {

          $(".form-input").removeClass("active-input");
          $(this).parent().addClass("active-input");
  })
})



function makeid(length) {
  var result           = '';
  var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}