$(document).ready(function(){

	//Tooltips	
    $('.form-tooltip').poshytip({ className: 'tip-yellowsimple', showOn: 'focus', alignTo: 'target', alignX: 'right', alignY: 'center', offsetX: 5 });
    
	//Rich text box

    if( $('textarea').length > 0 ) {
        if (!$("textarea").hasClass("full")) $("textarea").ckeditor();
        if ($("textarea").hasClass("full")) $("textarea").ckeditor({ toolbar: 'full' });
        for(var i in CKEDITOR.instances)  CKEDITOR.instances[i].on('blur', function() { this.updateElement(); });

        $('#btn-guardar').click(function() {
            for(var i in CKEDITOR.instances) CKEDITOR.instances[i].updateElement();
        });
    }

	// popup
	if (popup_es != 1) { 
		$('.colorbox').colorbox({ iframe:true,innerWidth:900, innerHeight:450   });
		$('.colorbox-clientes').colorbox({ iframe:true,innerWidth:900, innerHeight:450,  onClosed:function(){ window.location.reload();}  });
	}

	// Calendario
    $('.calendario').datepicker({  inline: true ,dateFormat: 'dd/mm/yy' ,changeMonth: true, changeYear: true, yearRange: "-80:+0" });

        /* toma el desde como fecha minima del hasta */
        $( ".calendario-desde" ).datepicker({  inline: true ,dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: "-80:+0",
          onClose: function( selectedDate ) {
            $( ".calendario-hasta" ).datepicker( "option", "minDate", selectedDate );
          }
        });
        $( ".calendario-hasta" ).datepicker({ inline: true ,dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: "-80:+0",
          onClose: function( selectedDate ) {
            $( ".calendario-desde" ).datepicker( "option", "maxDate", selectedDate );
          }
        });


	// menu 
	if (popup_es != 1) {
	       
           var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );

            //Para el responsive        
            $('#cbp-tm-menu').before('<div id="menu">Menú</div>');
        
            $('#menu').click(function()
            {
                $(this).toggleClass('active');
            });
    }
    
    //Para el responsive
     $('#listado table').wrap('<section class="table"></section>');
    
//placeholder
/*
    if (!Modernizr.input.placeholder) {
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('placeholder');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                   }
            }).blur();

            $('[placeholder]').parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                })
            });

            
        }
*/


        // PAra todos los modulos
        $('#btn-guardar').click(function() {
                for(var i in CKEDITOR.instances)
                    {
                    CKEDITOR.instances[i].updateElement();
                    }
        });
        
});