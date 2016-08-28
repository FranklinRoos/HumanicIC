$(document).ready(function () {
  
  $("#foto").change (function() {      
    var preview = document.querySelector('#foto');
    var files   = document.querySelector('input[type=file]').files;

    if (files) {
      [].forEach.call(files, readAndPreview);
    }

  });   

  function readAndPreview(file) {
        // Make sure `file.name` matches our extensions criteria
    if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
      var reader = new FileReader();

      reader.addEventListener("load", function () {
        var image = new Image();
        image.height = 100;
        image.title = file.name;
        image.src = this.result;
        $("#foto").attr("src", image.src);
        //preview.appendChild( image );
      }, false);

      reader.readAsDataURL(file);
    }
  };        
    
    $("#cv").change (function() {
        windows.location = windows.location;

    }); 
    
    
    
    


/*
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
       jQuery(function($){ //on document.ready
           $('#geboortedatum').datepicker();//het aanroepen van datepicker gebeurd gebeurd buiten document ready vanaf r563
           $('#geldigTot').datepicker();
       })
    }*/

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
        
        if ($("#functieCheck1").prop("checked") === true) {
                $("#ervaringSlider1").show();


                $('#ervaring1').slider({

                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                });
                $("#ervaring1").on("slide", function(slideEvt) {
                        $("#ex1SliderVal").text(slideEvt.value); 
                });
                $("#ervaring1").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });

            }
            else {					
                    $("#ervaringSlider1").hide();
            };

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
                                        $("#ervaring1").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
                                        
				}
				else {					
					$("#ervaringSlider1").hide();
				}
	});
        
        if ($("#functieCheck2").prop("checked") === true) {
                $("#ervaringSlider2").show();

                $('#ervaring2').slider({
                                                        tooltip : 'hide',
                                                        formatter: function(value) {
                                                                return 'Current value: ' + value;
                                                        }
                });
                $("#ervaring2").on("slide", function(slideEvt) {
                        $("#ex2SliderVal").text(slideEvt.value); 
                });
                $("#ervaring2").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {					
                $("#ervaringSlider2").hide();
        };
	
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
                                        $("#ervaring2").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider2").hide();
				}
	});	
	
        if ($("#functieCheck3").prop("checked") === true) {
                $("#ervaringSlider3").show();

                $('#ervaring3').slider({
                                                        
                                                        tooltip : 'hide',
                                                        formatter: function(value) {
                                                                return 'Current value: ' + value;
                                                        }
                });
                $("#ervaring3").on("slide", function(slideEvt) {
                        $("#ex3SliderVal").text(slideEvt.value); 
                });
                $("#ervaring3").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {					
                $("#ervaringSlider3").hide();
            };

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
                                        $("#ervaring3").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider3").hide();
				}
	});	
	
        if ($("#functieCheck4").prop("checked") === true) {
            $("#ervaringSlider4").show();

            $('#ervaring4').slider({
                                                    
                                                    tooltip : 'hide',
                                                    formatter: function(value) {
                                                            return 'Current value: ' + value;
                                                    }
            });
            $("#ervaring4").on("slide", function(slideEvt) {
                    $("#ex4SliderVal").text(slideEvt.value); 
            });
            $("#ervaring4").on("slideStop", function(slideEvt) {
                    $(this).val($(this).data('slider').getValue()); 
            });
        }
        else {					
                $("#ervaringSlider4").hide();
        };
        
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
                                        $("#ervaring4").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider4").hide();
				}
	});
        
        if ($("#functieCheck5").prop("checked") === true) {
            $("#ervaringSlider5").show();

            $('#ervaring5').slider({
                                                    
                                                    tooltip : 'hide',
                                                    formatter: function(value) {
                                                            return 'Current value: ' + value;
                                                    }
            });
            $("#ervaring5").on("slide", function(slideEvt) {
                    $("#ex5SliderVal").text(slideEvt.value); 
            });
            $("#ervaring5").on("slideStop", function(slideEvt) {
                    $(this).val($(this).data('slider').getValue()); 
            });
        }
        else {					
                $("#ervaringSlider5").hide();
        };
		
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
                                        $("#ervaring5").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider5").hide();
				}
	});
	
    if ($("#functieCheck6").prop("checked") === true) {
                    $("#ervaringSlider6").show();

                    $('#ervaring6').slider({
                       
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring6").on("slide", function(slideEvt) {
                            $("#ex6SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring6").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
        else {	

                        $("#ervaringSlider6").hide();
        };
        
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
                    $("#ervaring6").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider6").hide();
            }
	});
	
        if ($("#functieCheck7").prop("checked") === true) {
            $("#ervaringSlider7").show();

            $('#ervaring7').slider({
                
                tooltip : 'hide',
                formatter: function(value) {
                    return 'Current value: ' + value;
                }
            });
            $("#ervaring7").on("slide", function(slideEvt) {
                    $("#ex7SliderVal").text(slideEvt.value); 
            });
            $("#ervaring7").on("slideStop", function(slideEvt) {
                                        $(this).val($(this).data('slider').getValue()); 
                                });
            }
        else {	

                $("#ervaringSlider7").hide();
        };
        
        $("#functieCheck7").change(function() {
				
            if ($("#functieCheck7").prop("checked") == true) {
                    $("#ervaringSlider7").show();

                    $('#ervaring7').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring7").on("slide", function(slideEvt) {
                            $("#ex7SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring7").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider7").hide();
            }
	});
        
        if ($("#functieCheck8").prop("checked") === true) {
            $("#ervaringSlider8").show();

            $('#ervaring8').slider({
                
                tooltip : 'hide',
                formatter: function(value) {
                    return 'Current value: ' + value;
                }
            });
            $("#ervaring8").on("slide", function(slideEvt) {
                    $("#ex8SliderVal").text(slideEvt.value); 
            });
            $("#ervaring8").on("slideStop", function(slideEvt) {
                                        $(this).val($(this).data('slider').getValue()); 
                                });
        }
        else {	

                $("#ervaringSlider8").hide();
        };

        $("#functieCheck8").change(function() {
				
            if ($("#functieCheck8").prop("checked") == true) {
                    $("#ervaringSlider8").show();

                    $('#ervaring8').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring8").on("slide", function(slideEvt) {
                            $("#ex8SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring8").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider8").hide();
            }
	});
    
        if ($("#functieCheck9").prop("checked") === true) {
              $("#ervaringSlider9").show();

              $('#ervaring9').slider({
                
                  tooltip : 'hide',
                  formatter: function(value) {
                      return 'Current value: ' + value;
                  }
              });
              $("#ervaring9").on("slide", function(slideEvt) {
                      $("#ex9SliderVal").text(slideEvt.value); 
              });
              $("#ervaring9").on("slideStop", function(slideEvt) {
                                          $(this).val($(this).data('slider').getValue()); 
              });
        }
        else {	

                $("#ervaringSlider9").hide();
        };
        
        $("#functieCheck9").change(function() {
				
            if ($("#functieCheck9").prop("checked") == true) {
                    $("#ervaringSlider9").show();

                    $('#ervaring9').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring9").on("slide", function(slideEvt) {
                            $("#ex9SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring9").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
                    });
            }
            else {	

                    $("#ervaringSlider9").hide();
            }
	});
        
        if ($("#functieCheck99").prop("checked") === true) {
                $("#ervaringSlider99").show();

                $('#ervaring99').slider({
                
                    tooltip : 'hide',
                    formatter: function(value) {
                        return 'Current value: ' + value;
                    }
                });
                $("#ervaring99").on("slide", function(slideEvt) {
                        $("#ex99SliderVal").text(slideEvt.value); 
                });
                $("#ervaring99").on("slideStop", function(slideEvt) {
                                            $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {	

                $("#ervaringSlider99").hide();
        };
        
        $("#functieCheck99").change(function() {
				
            if ($("#functieCheck99").prop("checked") == true) {
                    $("#ervaringSlider99").show();
                    $("#nwFunctie").show();

                    $('#ervaring99').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring99").on("slide", function(slideEvt) {
                            $("#ex99SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring99").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
                    });
            }
            else {	

                    $("#ervaringSlider99").hide();
                    $("#nwFunctie").hide();
            }
	});

});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};


   

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
                        

 /*  var datefield=document.createElement("input")
      datefield.setAttribute("type", "date")
      if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
         document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
      }*/

