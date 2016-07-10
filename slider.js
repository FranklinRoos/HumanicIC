$(document).ready(function () {

	$("#rijbewijsCheck").change(function() {
				
				if ($("#rijbewijsCheck").prop("checked") == true) {
					$("#auto").show();
				}
				else {
					$("#auto").hide();
					$("#autoCheck").prop("checked", false);
				}
			});
			
	$(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

	$("#functieCheck1").change(function() {
				
				if ($("#functieCheck1").prop("checked") == true) {
					$("#ervaringSlider1").show();
					
					$('#ervaring1').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring1").on("slide", function(slideEvt) {
						$("#ex1SliderVal").text(slideEvt.value); 
					});
				}
				else {					
					$("#ervaringSlider1").hide();
				}
	});
	
	$("#functieCheck2").change(function() {
				
				if ($("#functieCheck2").prop("checked") == true) {
					$("#ervaringSlider2").show();
					
					$('#ervaring2').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring2").on("slide", function(slideEvt) {
						$("#ex2SliderVal").text(slideEvt.value); 
					});
				}
				else {					
					$("#ervaringSlider2").hide();
				}
	});	
	
	$("#functieCheck3").change(function() {
				
				if ($("#functieCheck3").prop("checked") == true) {
					$("#ervaringSlider3").show();
					
					$('#ervaring3').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring3").on("slide", function(slideEvt) {
						$("#ex3SliderVal").text(slideEvt.value); 
					});
				}
				else {					
					$("#ervaringSlider3").hide();
				}
	});	
	
	$("#functieCheck4").change(function() {
				
				if ($("#functieCheck4").prop("checked") == true) {
					$("#ervaringSlider4").show();
					
					$('#ervaring4').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring4").on("slide", function(slideEvt) {
						$("#ex4SliderVal").text(slideEvt.value); 
					});
				}
				else {					
					$("#ervaringSlider4").hide();
				}
	});
		
	$("#functieCheck5").change(function() {
				
				if ($("#functieCheck5").prop("checked") == true) {
					$("#ervaringSlider5").show();
					
					$('#ervaring5').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring5").on("slide", function(slideEvt) {
						$("#ex5SliderVal").text(slideEvt.value); 
					});
				}
				else {					
					$("#ervaringSlider5").hide();
				}
	});
		
	$("#functieCheck6").change(function() {
				
				if ($("#functieCheck6").prop("checked") == true) {
					$("#ervaringSlider6").show();
					
					$('#ervaring6').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring6").on("slide", function(slideEvt) {
						$("#ex6SliderVal").text(slideEvt.value); 
					});
				}
				else {	

					$("#ervaringSlider6").hide();
				}
	});
	

});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};

/* $(function(){
			$('#ervaring1').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			$('#ervaring2').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			});
			
			$("#ervaring1").on("slide", function(slideEvt) {
				$("#ex1SliderVal").text(slideEvt.value); 
			});
			
			
			$("#ervaring2").on("slide", function(slideEvt) {
				$("#ex21SliderVal").text(slideEvt.value); 
			});
 */


/* $("#functieCheck1").change(function() {	
					alert("oke");
}); */
/* $(function(){
				$('#ervaring1').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring2').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring3').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring4').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring5').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring6').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			}): */
				/* $('#ervaring1').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				
				$('#ervaring2').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				$('#ervaring3').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});	
				$('#ervaring4').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});	
				$('#ervaring5').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				$('#ervaring6').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
 */
            /* }); */
			$("#ervaring1").on("slide", function(slideEvt) {
				$("#ex1SliderVal").text(slideEvt.value);
			});
			$("#ervaring2").on("slide", function(slideEvt) {
				$("#ex2SliderVal").text(slideEvt.value);
			});
			
			$("#ervaring3").on("slide", function(slideEvt) {
				$("#ex3SliderVal").text(slideEvt.value);
			});
			$("#ervaring4").on("slide", function(slideEvt) {
				$("#ex4SliderVal").text(slideEvt.value);
			});
			$("#ervaring5").on("slide", function(slideEvt) {
				$("#ex5SliderVal").text(slideEvt.value);
			});
			$("#ervaring6").on("slide", function(slideEvt) {
				$("#ex6SliderVal").text(slideEvt.value);
			});