// next prev function
$(document).ready(function() {
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

      // console.log(sede)
      // console.log(carrera)
      // console.log(semestre)
      // console.log(area)
      // console.log(sugerencia)

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
          sugerencia: sugerencia
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



  // btnSugerencia


  // $(".prev").click(function() {
  //     divs.eq(now).hide();
  //     now = (now > 0) ? now - 1 : divs.length - 1;
  //     divs.eq(now).show(); // show previous
  // });
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