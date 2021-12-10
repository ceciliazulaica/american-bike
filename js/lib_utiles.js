function word_limpiar(Cadena) {			
	//Limpiar basura.			
/*	return ( Cadena.replace(/<!--[if gte([x00-x7F]*)-->/ig, '') );*/
}


function chk_check_all(class_name){
    
        $("."+class_name).each(function()    
        {    
            this.checked = true;    
        });
    
}
function chk_uncheck_all(class_name){
    
        $("."+class_name).each(function()    
        {    
            this.checked = false;    
        });
}


function onError(tx, error) {
        alert(error.message);
}


function form_reset(form_name) {
	 
    $("#"+form_name).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}


function escape_string(str){
	//Escapa un texto
	if (str != '') str.replace(/['\"]/g, "") 
	return (str);
}



function fmt_string_sin_null(texto) {
	
	// Formatea el texto sin caracteres raros
	//texto.replace(/&/g, "&amp ;").replace(/</g, "&lt ;").replace(/>/g, "&gt ;");
	
	texto= escape_string(texto);
	
	return("'"+texto+"'");
}



function isNumber(n) {
	// Es numerica
  return !isNaN(parseFloat(n)) && isFinite(n);
}



function fmt_fecha(fecha_dd_mm_yyyy) {
	
	// Formatea la fecha para el mysql-lite
	
	var fecha_vec 	= fecha_dd_mm_yyyy.split("/");
	var dia			= fecha_vec[0];
	var mes			= fecha_vec[1];
	var anio		= fecha_vec[2];

	return("date('"+anio+"-"+mes+"-"+dia+"')");	
}
function fmt_num_sin_null(texto) {
	if (isNumber(texto)) {
		return(texto);
	}else{
		return(0);
	}
}


function validateEmail( strValue) {
/************************************************
DESCRIPTION: Validates that a string contains a
  valid email pattern.

 PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.

REMARKS: Accounts for email with country appended
  does not validate that email contains valid URL
  type (.com, .gov, etc.) or valid country suffix.
*************************************************/
 //var objRegExp  =/(^[a-z]([a-z_\.]*)@([a-z_\.]*)([.][a-z]{3})$)|(^[a-z]([a-z_\.]*)@([a-z_\.]*)(\.[a-z]{3})(\.[a-z]{2})*$)/i;
  //check for valid email
  //return objRegExp.test(strValue);
  
  
  return (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(strValue));
  
}

function validateUSPhone( strValue ) {
/************************************************
DESCRIPTION: Validates that a string contains valid
  US phone pattern.
  Ex. (999) 999-9999 or (999)999-9999

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.
*************************************************/
  var objRegExp  = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;

  //check for valid us phone with or without space between
  //area code
  return objRegExp.test(strValue);
}

function  validateNumeric( strValue ) {
/*****************************************************************
DESCRIPTION: Validates that a string contains only valid numbers.

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.
******************************************************************/
  var objRegExp  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;

  //check for numeric characters
  return objRegExp.test(strValue);
}

function validateInteger( strValue ) {
/************************************************
DESCRIPTION: Validates that a string contains only
    valid integer number.

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.
**************************************************/
  var objRegExp  = /(^-?\d\d*$)/;

  //check for integer characters
  return objRegExp.test(strValue);
}

function validateNotEmpty( strValue ) {
/************************************************
DESCRIPTION: Validates that a string is not all
  blank (whitespace) characters.

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.
*************************************************/
   var strTemp = strValue;
   strTemp = trimAll(strTemp);
   if(strTemp.length > 0){
     return true;
   }
   return false;
}

function validateUSZip( strValue ) {
/************************************************
DESCRIPTION: Validates that a string a United
  States zip code in 5 digit format or zip+4
  format. 99999 or 99999-9999

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.

*************************************************/
var objRegExp  = /(^\d{5}$)|(^\d{5}-\d{4}$)/;

  //check for valid US Zipcode
  return objRegExp.test(strValue);
}

function validateUSDate( strValue ) {
/************************************************
DESCRIPTION: Validates that a string contains only
    valid dates with 2 digit month, 2 digit day,
    4 digit year. Date separator can be ., -, or /.
    Uses combination of regular expressions and
    string parsing to validate date.
    Ex. mm/dd/yyyy or mm-dd-yyyy or mm.dd.yyyy

PARAMETERS:
   strValue - String to be tested for validity

RETURNS:
   True if valid, otherwise false.

REMARKS:
   Avoids some of the limitations of the Date.parse()
   method such as the date separator character.
*************************************************/
  var objRegExp = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
 
  //check to see if in correct format
  if(!objRegExp.test(strValue))
    return false; //doesn't match pattern, bad date
  else{
    var strSeparator = strValue.substring(2,3) 
    var arrayDate = strValue.split(strSeparator); 
    //create a lookup for months not equal to Feb.
    var arrayLookup = { '01' : 31,'03' : 31, 
                        '04' : 30,'05' : 31,
                        '06' : 30,'07' : 31,
                        '08' : 31,'09' : 30,
                        '10' : 31,'11' : 30,'12' : 31}
    var intDay = parseInt(arrayDate[1],10); 

    //check if month value and day value agree
    if(arrayLookup[arrayDate[0]] != null) {
      if(intDay <= arrayLookup[arrayDate[0]] && intDay != 0)
        return true; //found in lookup table, good date
    }
    
    //check for February (bugfix 20050322)
    //bugfix  for parseInt kevin
    //bugfix  biss year  O.Jp Voutat
    var intMonth = parseInt(arrayDate[0],10);
    if (intMonth == 2) { 
       var intYear = parseInt(arrayDate[2]);
       if (intDay > 0 && intDay < 29) {
           return true;
       }
       else if (intDay == 29) {
         if ((intYear % 4 == 0) && (intYear % 100 != 0) || 
             (intYear % 400 == 0)) {
              // year div by 4 and ((not div by 100) or div by 400) ->ok
             return true;
         }   
       }
    }
  }  
  return false; //any other values, bad date
}

function validateValue( strValue, strMatchPattern ) {
/************************************************
DESCRIPTION: Validates that a string a matches
  a valid regular expression value.

PARAMETERS:
   strValue - String to be tested for validity
   strMatchPattern - String containing a valid
      regular expression match pattern.

RETURNS:
   True if valid, otherwise false.
*************************************************/
var objRegExp = new RegExp( strMatchPattern);

 //check if string matches pattern
 return objRegExp.test(strValue);
}


function rightTrim( strValue ) {
/************************************************
DESCRIPTION: Trims trailing whitespace chars.

PARAMETERS:
   strValue - String to be trimmed.

RETURNS:
   Source string with right whitespaces removed.
*************************************************/
var objRegExp = /^([\w\W]*)(\b\s*)$/;

      if(objRegExp.test(strValue)) {
       //remove trailing a whitespace characters
       strValue = strValue.replace(objRegExp, '$1');
    }
  return strValue;
}

function leftTrim( strValue ) {
/************************************************
DESCRIPTION: Trims leading whitespace chars.

PARAMETERS:
   strValue - String to be trimmed

RETURNS:
   Source string with left whitespaces removed.
*************************************************/
var objRegExp = /^(\s*)(\b[\w\W]*)$/;

      if(objRegExp.test(strValue)) {
       //remove leading a whitespace characters
       strValue = strValue.replace(objRegExp, '$2');
    }
  return strValue;
}

function trimAll( strValue ) {
/************************************************
DESCRIPTION: Removes leading and trailing spaces.

PARAMETERS: Source string from which spaces will
  be removed;

RETURNS: Source string with whitespaces removed.
*************************************************/
 var objRegExp = /^(\s*)$/;

    //check for all spaces
    if(objRegExp.test(strValue)) {
       strValue = strValue.replace(objRegExp, '');
       if( strValue.length == 0)
          return strValue;
    }

   //check for leading & trailing spaces
   objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
   if(objRegExp.test(strValue)) {
       //remove leading and trailing whitespace characters
       strValue = strValue.replace(objRegExp, '$2');
    }
  return strValue;
}

function removeCurrency( strValue ) {
/************************************************
DESCRIPTION: Removes currency formatting from
  source string.

PARAMETERS:
  strValue - Source string from which currency formatting
     will be removed;

RETURNS: Source string with commas removed.
*************************************************/
  var objRegExp = /\(/;
  var strMinus = '';

  //check if negative
  if(objRegExp.test(strValue)){
    strMinus = '-';
  }

  objRegExp = /\)|\(|[,]/g;
  strValue = strValue.replace(objRegExp,'');
  if(strValue.indexOf('$') >= 0){
    strValue = strValue.substring(1, strValue.length);
  }
  return strMinus + strValue;
}

function addCurrency( strValue ) {
/************************************************
DESCRIPTION: Formats a number as currency.

PARAMETERS:
  strValue - Source string to be formatted

REMARKS: Assumes number passed is a valid
  numeric value in the rounded to 2 decimal
  places.  If not, returns original value.
*************************************************/
  var objRegExp = /-?[0-9]+\.[0-9]{2}$/;

    if( objRegExp.test(strValue)) {
      objRegExp.compile('^-');
      strValue = addCommas(strValue);
      if (objRegExp.test(strValue)){
        strValue = '(' + strValue.replace(objRegExp,'') + ')';
      }
      return '$' + strValue;
    }
    else
      return strValue;
}

function removeCommas( strValue ) {
/************************************************
DESCRIPTION: Removes commas from source string.

PARAMETERS:
  strValue - Source string from which commas will
    be removed;

RETURNS: Source string with commas removed.
*************************************************/
  var objRegExp = /,/g; //search for commas globally

  //replace all matches with empty strings
  return strValue.replace(objRegExp,'');
}

function addCommas( strValue ) {
/************************************************
DESCRIPTION: Inserts commas into numeric string.

PARAMETERS:
  strValue - source string containing commas.

RETURNS: String modified with comma grouping if
  source was all numeric, otherwise source is
  returned.

REMARKS: Used with integers or numbers with
  2 or less decimal places.
*************************************************/
  var objRegExp  = new RegExp('(-?[0-9]+)([0-9]{3})');

    //check for match to search criteria
    while(objRegExp.test(strValue)) {
       //replace original string with first group match,
       //a comma, then second group match
       strValue = strValue.replace(objRegExp, '$1,$2');
    }
  return strValue;
}

function removeCharacters( strValue, strMatchPattern ) {
/************************************************
DESCRIPTION: Removes characters from a source string
  based upon matches of the supplied pattern.

PARAMETERS:
  strValue - source string containing number.

RETURNS: String modified with characters
  matching search pattern removed

USAGE:  strNoSpaces = removeCharacters( ' sfdf  dfd',
                                '\s*')
*************************************************/
 var objRegExp =  new RegExp( strMatchPattern, 'gi' );

 //replace passed pattern matches with blanks
  return strValue.replace(objRegExp,'');
}


function fmt_fecha_explitica(retorna_valor){
	/*
		RETORNA:
			LA FECHA COMPLETA CON DIA+MES + AÑO
			<<< la saque de las librerias que me paso Adriana >>>>
	*/
var now = new Date()
var dia = now.getDay()
var mes = now.getMonth()
var fecha



//El día de la semana
if(dia==0){
 fecha="Domingo, ";
}else if(dia==1){
 fecha="Lunes, ";
}else if(dia==2){
 fecha="Martes, ";
}else if(dia==3){
 fecha="Miércoles, ";
}else if(dia==4){
 fecha="Jueves, ";
}else if(dia==5){
 fecha="Viernes, ";
}else{
 fecha="Sábado, ";
}

fecha = fecha + now.getDate() + " de "
//El nombre del mes
if(mes==0){
 fecha=fecha + "Enero"
}else if(mes==1){
 fecha=fecha + "Febrero"
}else if(mes==2){
 fecha=fecha + "Marzo"
}else if(mes==3){
 fecha=fecha + "Abril"
}else if(mes==4){
 fecha=fecha + "Mayo"
}else if(mes==5){
 fecha=fecha + "Junio"
}else if(mes==6){
 fecha=fecha + "Julio"
}else if(mes==7){
 fecha=fecha + "Agosto"
}else if(mes==8){
 fecha=fecha + "Septiembre"
}else if(mes==9){
 fecha=fecha + "Octubre"
}else if(mes==10){
 fecha=fecha + "Noviembre"
}else{
 fecha=fecha + "Diciembre"
}

var anio;
anio = now.getFullYear();

fecha = fecha + " del " + anio;

if (retorna_valor)
   return fecha;
else{
   document.write(fecha);
   return true
   }

}






function pop_up_print_y_desaparecer(pagina_dir) {
	var imp_win = window.open(String(pagina_dir));
	//imp_win.document.write("<html><body bgcolor='#FFFFFF'>");
	imp_win.print();
	imp_win.close();
}


		
function imprimir_div(div_impresion){
		if (document.getElementById != null)
		{
			var html = '<HTML>\n<HEAD>\n';
	
			if (document.getElementsByTagName != null)
			{
			
				var headTags = document.getElementsByTagName("head");

				if (headTags.length > 0)
					html += headTags[0].innerHTML;
			}
			
			html += "<link href='../css/backend.css' rel='stylesheet' type='text/css'>";
			html += '\n</HE' + 'AD>\n<BODY bgcolor="#FFFFFF">\n<div id="container"><div id="main">\n';
			
			var printReadyElem = document.getElementById(div_impresion);
			
			if (printReadyElem != null)	{
					html += printReadyElem.innerHTML;
			}else{
				alert("Imposible imprimir");
				return;
			}
			html= html.replace(/<a.*href="(.*?)">/g, '');
            html= html.replace(/<\/a>/g, '');
				
			html += '</div></div>\n</BODY>\n</HTML>';
			
			var printWin = window.open("");
			printWin.document.open();
			printWin.document.write(html);
			printWin.document.close();
			printWin.print();
		}
		else
		{
			alert("Sorry, the print ready feature is only available in modern browsers.");
		}		
}
