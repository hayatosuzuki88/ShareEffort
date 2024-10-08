

const formMinutesValue = document.forms.routine_form.minutes_value; 
const formBodyValue = document.forms.routine_form.body_value; 
const formTitleValue = document.forms.routine_form.title_value;

formMinutesValue.addEventListener('input',()=>{     
  let minutes  = document.getElementById('minutes');
  minutes.textContent = "頑張った時間："+ formMinutesValue.value +"分間";
})

formBodyValue.addEventListener('input',()=>{     
  let body  = document.getElementById('body');
  body.textContent = formBodyValue.value;
})

formTitleValue.addEventListener('input',()=>{     
  let title  = document.getElementById('title');
  title.textContent = formTitleValue.value;
})

$('#image').on('change', function(){
  var $fr = new FileReader();
	$fr.onload = function(){
		$('#preview').attr('src', $fr.result);
	}
	$fr.readAsDataURL(this.files[0]);
});
