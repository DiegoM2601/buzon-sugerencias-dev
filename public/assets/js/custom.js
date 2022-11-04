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

  

  var divs = $('.show-section>.steps-inner');
  var now = 0; // currently shown div
  divs.hide().first().show(); // hide all divs except first

  $("#btnContinuar").click(function(){
    $("#step-0").hide();
    $("#step-1").show()
  })

  $("#btnSede").click(function(){
    var isValid = $("input[name=sede]").is(":checked");
    // console.log(isValid)
    if(isValid){
      $("#step-1").hide();
      $("#step-2").show()
    }else{
      // console.log("Error")
      $("#errorSede").show();
    }
  })

  $(document).on('change', 'input[type=radio][name=sede]', function (event) {
    $("#errorSede").hide();
  });


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

    var sede = $('input:radio[name=sede]:checked').val()

    var cbb = ['ADM', 'BYF', 'DER', 'DGP',  'ICO', 'IEF', 'MED', 'ODO', 'PSI', 'PYM', 'SIS']
    var eat = ['ADM', 'AHT', 'BYF', 'CPU', 'DER', 'DGP', 'ENF', 'ICO', 'MED', 'ODO', 'PSI', 'SIS']
    var lpz = ['ADM', 'AHT', 'BYF', 'CPU', 'DER', 'DGP', 'ICO', 'IEC', 'MED', 'ODO', 'PER', 'PSI', 'PYM', 'SIS']
    var scz = ['ADM', 'AHT', 'ARQ', 'BYF', 'CPU', 'DER', 'DGP', 'ENF', 'ICO', 'MED', 'ODO', 'PER', 'PSI', 'PYM', 'SIS']

    var value = $(this).val()
    const isInArray = cbb.includes(value)

    if((!cbb.includes(value) && sede == 'CBB') || (!eat.includes(value) && sede == 'EAT') || (!lpz.includes(value) && sede == 'LPZ') || (!scz.includes(value) && sede == 'SCZ')){
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
    }else if ($("#sugerencia").val() == null || $("#sugerencia").val() == ''){
      $("#errorSugerencia").show();
    }else{
      // $("#step-4").hide();

      // ajax!!

      var sede = $("input[name=sede]:checked").val();
      var carrera = $("input[name=carrera]:checked").val();
      var semestre = $("input[name=semestre]:checked").val();
      var area = $("#area").val() 
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



  $("#area").on('change', function() {
    $("#errorArea").hide()
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
    $("#step-4").hide();
    $("#step-3").show()
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