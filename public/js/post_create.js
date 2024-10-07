function isNumber(val) {
  var regexp = new RegExp('^(0|[1-9][0-9]*)$');
  return regexp.test(val);
}

;
(function() {
    $('#form').submit(function() {
        
        if ($('#title').val() == '') {
            $('#title-error').css('display', 'block');
            return false;
        } else {
            $('#title-error').css('display', 'none');
        }
        
        if ($('#task').val() == '') {
            $('#task-error').css('display', 'block');
            return false;
        } else {
            $('#task-error').css('display', 'none');
        }
        
        if ($('#minutes').val() == 0) {
            $('#minutes-error').css('display', 'block');
            $('#minutes-error').text('分数が0になっています。');
            return false;
        } else if (!isNumber($('#minutes').val())){
            $('#minutes-error').css('display', 'block');
            $('#minutes-error').text('数字を入力してください。');
            return false;
        } else {
            $('#minutes-error').css('display', 'none');
        }
        
        if ($('#image').val() == '') {
            $('#image-error').css('display', 'block');
            return false;
        } else {
            $('#image-error').css('display', 'none');
        }
        
        return true;
    })

})();