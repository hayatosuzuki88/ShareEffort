function isNumber(val) {
  var regexp = new RegExp('^(|[1-9]\d*)$');
  return regexp.test(val);
}

;
(function() {
    $('#routine_form').submit(function() {
        
        if ($('#title_Value').val() == '') {
            $('#title-error').css('display', 'block');
            return false;
        } else {
            $('#title-error').css('display', 'none');
        }
        
        if (!isNumber($('#minutes_value').val())){
            $('#minutes-error').css('display', 'block');
            return false;
        } else {
            $('#minutes-error').css('display', 'none');
        }
        
        return true;
    })
})();